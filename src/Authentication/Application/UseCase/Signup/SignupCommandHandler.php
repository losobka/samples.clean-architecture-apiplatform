<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\Authentication\Application\UseCase\Signup;

use App\User\Domain\Repository\UserRepository;
use RuntimeException;
use App\Authentication\Application\DTO\AuthTokenDTO;
use App\Authentication\Application\Service\AuthTokenCreator;
use App\Authentication\Domain\Entity\UserCredential;
use App\Authentication\Domain\Exception\CredentialNotFoundForUsername;
use App\Authentication\Domain\Exception\UsernameAlreadyUsed;
use App\Authentication\Domain\Repository\UserCredentialRepository;
use App\Authentication\Domain\Service\PasswordHasher;
use App\Authentication\Domain\ValueObject\Password;
use App\Authentication\Domain\ValueObject\Username;
use App\Common\Application\Command\CommandBus;
use App\Common\Application\Command\CommandHandler;
use App\User\Application\DTO\UserDTO;
use App\User\Application\UseCase\CreateUser\CreateUserCommand;
use App\User\Domain\ValueObject\UserId;

final readonly class SignupCommandHandler implements CommandHandler
{
    public function __construct(
        private CommandBus $commandBus,
        private PasswordHasher $passwordHasher,
        private UserCredentialRepository $userCredentialRepository,
        private UserRepository $userRepository,
        private AuthTokenCreator $authTokenCreator,
    ) {
    }

    /**
     * @throws UsernameAlreadyUsed
     */
    public function __invoke(SignupCommand $command): AuthTokenDTO
    {
        $this->ensurePasswordConfirmIsValid(Password::fromString($command->password), Password::fromString
        (value: $command->passwordConfirm, ensureIsStrength: false));
        $this->ensureUsernameIsAvailable(Username::fromString($command->email));

        // User is created first for generate UserId to use in creating of credentials
        $userDTO = $this->createUser(
            firstName: $command->firstName,
            lastName: $command->lastName,
            email: $command->email,
        );

        $user = $this->userRepository->get(id: UserId::fromString($userDTO->id));;

        $userCredential = UserCredential::create(
//            id: $user->id(),
            user: $user,
            username: Username::fromString($command->email),
            hashedPassword: $this->passwordHasher->hash(Password::fromString($command->password))
        );

        $this->userCredentialRepository->add($userCredential);

        return $this->authTokenCreator->createFromUserDTO($userDTO);
    }

    private function ensurePasswordConfirmIsValid(Password $password, Password $passwordConfirm): void
    {
        if (!$password->isEqual($passwordConfirm)) {
            throw new RuntimeException('Invalid password confirm');
        }
    }

    /**
     * @throws UsernameAlreadyUsed
     */
    private function ensureUsernameIsAvailable(Username $username): void
    {
        try {
            $this->userCredentialRepository->getByUsername($username);
        } catch (CredentialNotFoundForUsername) {
            return;
        }

        throw new UsernameAlreadyUsed($username);
    }

    private function createUser(string $firstName, string $lastName, string $email): UserDTO
    {
        return $this->commandBus
            ->dispatch(
                new CreateUserCommand(
                    firstName: $firstName,
                    lastName: $lastName,
                    email: $email,
                )
            );
    }
}

<?php

declare(strict_types=1);

namespace App\Authentication\Application\UseCase\Signup;

use App\Authentication\Application\DTO\AuthTokenDTO;
use App\Authentication\Application\Service\TokenEncoder;
use App\Authentication\Domain\Entity\UserCredential;
use App\Authentication\Domain\Exception\CredentialNotFoundForUsername;
use App\Authentication\Domain\Exception\UsernameAlreadyUsed;
use App\Authentication\Domain\Repository\UserCredentialRepository;
use App\Authentication\Domain\Service\PasswordHasher;
use App\Authentication\Domain\ValueObject\Password;
use App\Authentication\Domain\ValueObject\Username;
use App\Backoffice\User\Application\DTO\UserDTO;
use App\Backoffice\User\Application\UseCase\CreateUser\CreateUserCommand;
use App\Backoffice\User\Domain\ValueObject\UserId;
use App\Common\Application\Command\CommandBus;
use App\Common\Application\Command\CommandHandler;

final class SignupCommandHandler implements CommandHandler
{
    public function __construct(
        private readonly CommandBus $commandBus,
        private readonly PasswordHasher $passwordHasher,
        private readonly UserCredentialRepository $userCredentialRepository,
        private readonly TokenEncoder $tokenEncoder,
    ) {
    }

    /**
     * @throws UsernameAlreadyUsed
     */
    public function __invoke(SignupCommand $command): AuthTokenDTO
    {
        $this->ensurePasswordConfirmIsValid(Password::fromString($command->password), Password::fromString($command->passwordConfirm));
        $this->ensureUsernameIsAvailable(Username::fromString($command->email));

        // User is created first for generate UserId to use in creating of credentials
        $user = $this->createUser(
            firstName: $command->firstName,
            lastName: $command->lastName,
            email: $command->email,
        );

        $userCredential = UserCredential::create(
            userId: UserId::fromString($user->id),
            username: Username::fromString($command->email),
            hashedPassword: $this->passwordHasher->hash(Password::fromString($command->password)),
        );

        $this->userCredentialRepository->add($userCredential);

        $tokenPayload = [
            'userId' => $user->id,
            'email' => $user->email,
            'firstName' => $user->firstName,
            'lastName' => $user->lastName,
        ];

        return AuthTokenDTO::fromString($this->tokenEncoder->encode($tokenPayload));
    }

    private function ensurePasswordConfirmIsValid(Password $password, Password $passwordConfirm): void
    {
        if (!$password->isEqual($passwordConfirm)) {
            throw new \RuntimeException('Invalid password confirm');
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

<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\Authentication\Application\UseCase\Login;

use App\User\Domain\Repository\UserRepository;
use Exception;
use App\Authentication\Application\DTO\AuthTokenDTO;
use App\Authentication\Application\Service\AuthTokenCreator;
use App\Authentication\Domain\Exception\InvalidCredentials;
use App\Authentication\Domain\Repository\UserCredentialRepository;
use App\Authentication\Domain\Service\PasswordHasher;
use App\Authentication\Domain\ValueObject\Password;
use App\Authentication\Domain\ValueObject\Username;
use App\Common\Application\Command\CommandHandler;
use App\Common\Application\Query\QueryBus;
use App\User\Application\DTO\UserDTO;
use App\User\Application\UseCase\GetUserById\GetUserByIdQuery;

final readonly class LoginCommandHandler implements CommandHandler
{
    public function __construct(
        private QueryBus $queryBus,
        private UserCredentialRepository $userCredentialRepository,
        private UserRepository $userRepository,
        private PasswordHasher $passwordHasher,
        private AuthTokenCreator $authTokenCreator,
    ) {
    }

    /**
     * @throws InvalidCredentials
     */
    public function __invoke(LoginCommand $command): AuthTokenDTO
    {
        try {
            $userCredential = $this->userCredentialRepository->getByUsername(Username::fromString($command->username));
        } catch (Exception) {
            throw new InvalidCredentials();
        }

        if (!$this->passwordHasher->verify($userCredential->hashedPassword(), Password::fromString($command->password))) {
            throw new InvalidCredentials();
        }

        /** @var UserDTO $userDTO */
        $userDTO = $this->queryBus
            ->ask(
                new GetUserByIdQuery(
                    userId: (string) $userCredential->user()->Id(),
                )
            );

        $user = $this->userRepository->get(id: $userCredential->user()->id());

        $user->login();

        return $this->authTokenCreator->createFromUserDTO($userDTO);
    }
}

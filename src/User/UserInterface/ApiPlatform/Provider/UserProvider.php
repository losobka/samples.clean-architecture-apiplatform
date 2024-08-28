<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\User\UserInterface\ApiPlatform\Provider;

use Override;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Common\Application\Query\QueryBus;
use App\User\Application\DTO\UserDTO;
use App\User\Application\UseCase\GetUserById\GetUserByIdQuery;
use App\User\Domain\Exception\UserNotFound;
use App\User\UserInterface\ApiPlatform\Resource\UserResource;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @template-implements ProviderInterface<UserResource>
 */
final readonly class UserProvider implements ProviderInterface
{
    public function __construct(
        private QueryBus $queryBus,
    ) {
    }

    #[Override]
    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        try {
            $userId = (string) $uriVariables['id'];
            $userDTO = $this->getUserById($userId);
        } catch (UserNotFound $userNotFound) {
            throw new NotFoundHttpException($userNotFound->getMessage());
        }

        return UserResource::fromUserDTO($userDTO);
    }

    /**
     * @throws UserNotFound
     */
    private function getUserById(string $userId): UserDTO
    {
        return $this->queryBus->ask(new GetUserByIdQuery($userId));
    }
}

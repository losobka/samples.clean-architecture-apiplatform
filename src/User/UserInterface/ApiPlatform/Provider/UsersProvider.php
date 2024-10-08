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
use ApiPlatform\State\Pagination\Pagination;
use ApiPlatform\State\ProviderInterface;
use App\Common\Application\Query\QueryBus;
use App\User\Application\DTO\UserDTO;
use App\User\Application\UseCase\SearchUsersPaginated\SearchUsersPaginatedQuery;
use App\User\UserInterface\ApiPlatform\Resource\UserResource;

/**
 * @template-implements ProviderInterface<UserResource>
 */
final readonly class UsersProvider implements ProviderInterface
{
    public function __construct(
        private QueryBus $queryBus,
        private Pagination $pagination,
    ) {
    }

    /**
     * @return UserResource[]
     */
    #[Override]
    public function provide(Operation $operation, array $uriVariables = [], array $context = []): array
    {
        $page = $this->pagination->getPage($context);
        $itemsPerPage = $this->pagination->getLimit($operation, $context);

        $users = $this->getUsersDTOs($page, $itemsPerPage);

        return $this->mapUserDTOsToUsersResources($users);
    }

    /**
     * @return UserDTO[]
     */
    private function getUsersDTOs(int $page, int $itemsPerPage): array
    {
        return $this->queryBus->ask(new SearchUsersPaginatedQuery($page, $itemsPerPage));
    }

    /**
     * @return UserResource[]
     */
    private function mapUserDTOsToUsersResources(array $usersDTOs): array
    {
        $resources = [];
        foreach ($usersDTOs as $userDTO) {
            $resources[] = UserResource::fromUserDTO($userDTO);
        }

        return $resources;
    }
}

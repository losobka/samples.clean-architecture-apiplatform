<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\User\Application\UseCase\GetUserById;

use App\Common\Application\Query\QueryHandler;
use App\User\Application\DTO\UserDTO;
use App\User\Domain\Exception\UserNotFound;
use App\User\Domain\Repository\UserRepository;
use App\User\Domain\ValueObject\UserId;

final readonly class GetUserByIdQueryHandler implements QueryHandler
{
    public function __construct(
        private UserRepository $userRepository,
    ) {
    }

    /**
     * @throws UserNotFound
     */
    public function __invoke(GetUserByIdQuery $query): ?UserDTO
    {
        $user = $this->userRepository->get(UserId::fromString($query->userId));

        return UserDTO::fromEntity($user);
    }
}

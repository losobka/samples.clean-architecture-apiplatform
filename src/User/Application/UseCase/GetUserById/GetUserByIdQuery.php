<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\User\Application\UseCase\GetUserById;

use App\Common\Application\Query\Query;

final readonly class GetUserByIdQuery implements Query
{
    public function __construct(
        public string $userId,
    ) {
    }
}

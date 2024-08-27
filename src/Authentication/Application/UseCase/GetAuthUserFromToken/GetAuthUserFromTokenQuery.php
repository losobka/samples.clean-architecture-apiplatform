<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\Authentication\Application\UseCase\GetAuthUserFromToken;

use App\Common\Application\Query\Query;

final readonly class GetAuthUserFromTokenQuery implements Query
{
    public function __construct(
        public string $token,
    ) {
    }
}

<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\Authentication\Application\UseCase\GetAuthUserFromToken;

use App\Authentication\Application\DTO\AuthUserDTO;
use App\Authentication\Application\Service\TokenDecoder;
use App\Common\Application\Query\QueryHandler;

final readonly class GetAuthUserFromTokenQueryHandler implements QueryHandler
{
    public function __construct(
        private TokenDecoder $tokenDecoder,
    ) {
    }

    public function __invoke(GetAuthUserFromTokenQuery $query): AuthUserDTO
    {
        return AuthUserDTO::createFromJWTPayload($this->tokenDecoder->decode($query->token));
    }
}

<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\Authentication\UserInterface\ApiPlatform\Output;

use App\Authentication\Application\DTO\AuthTokenDTO;

final readonly class JWT
{
    private function __construct(
        public string $token,
    ) {
    }

    public static function fromAuthTokenDTO(AuthTokenDTO $authToken): JWT
    {
        return new self((string) $authToken);
    }
}

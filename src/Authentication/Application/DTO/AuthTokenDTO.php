<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\Authentication\Application\DTO;

use Stringable;

final readonly class AuthTokenDTO implements Stringable
{
    private function __construct(
        public string $token,
    ) {
    }

    public static function fromString(string $token): AuthTokenDTO
    {
        return new self(token: $token);
    }

    public function __toString(): string
    {
        return $this->token;
    }
}

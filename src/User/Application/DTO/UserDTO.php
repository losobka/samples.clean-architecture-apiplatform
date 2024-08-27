<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\User\Application\DTO;

use App\User\Domain\Entity\User;

final readonly class UserDTO
{
    private function __construct(
        public string $id,
        public string $firstName,
        public string $lastName,
        public string $email,
    ) {
    }

    public static function fromEntity(User $user): self
    {
        return new self(
            id: (string) $user->id(),
            firstName: (string) $user->firstName(),
            lastName: (string) $user->lastName(),
            email: (string) $user->email(),
        );
    }
}

<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\Authentication\Application\DTO;

use App\User\Application\DTO\UserDTO;

final readonly class AuthUserDTO
{
    private function __construct(
        public string $userId,
        public string $firstName,
        public string $lastName,
        public string $email,
    ) {
    }

    public static function createFromUserDTO(UserDTO $userDTO): AuthUserDTO
    {
        return new self(
            userId: $userDTO->id,
            firstName: $userDTO->firstName,
            lastName: $userDTO->lastName,
            email: $userDTO->email,
        );
    }

    public static function createFromJWTPayload(array $jwtPayload): AuthUserDTO
    {
        return new self(
            userId: $jwtPayload['userId'],
            firstName: $jwtPayload['firstName'],
            lastName: $jwtPayload['lastName'],
            email: $jwtPayload['email'],
        );
    }
}

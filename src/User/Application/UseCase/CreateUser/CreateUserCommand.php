<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\User\Application\UseCase\CreateUser;

use App\Common\Application\Command\Command;

final readonly class CreateUserCommand implements Command
{
    public function __construct(
        public string $firstName,
        public string $lastName,
        public string $email,
    ) {
    }
}

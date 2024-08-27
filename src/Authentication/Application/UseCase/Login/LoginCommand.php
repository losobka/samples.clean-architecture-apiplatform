<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\Authentication\Application\UseCase\Login;

use App\Common\Application\Command\Command;

final readonly class LoginCommand implements Command
{
    public function __construct(
        public string $username,
        public string $password,
    ) {
    }
}

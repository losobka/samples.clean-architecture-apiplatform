<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\Authentication\Application\UseCase\Signup;

use App\Common\Application\Command\Command;

final readonly class SignupCommand implements Command
{
    public function __construct(
        public string $firstName,
        public string $lastName,
        public string $email,
        public string $password,
        public string $passwordConfirm,
    ) {
    }
}

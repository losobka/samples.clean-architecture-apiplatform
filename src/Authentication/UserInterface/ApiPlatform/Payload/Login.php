<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\Authentication\UserInterface\ApiPlatform\Payload;

use Symfony\Component\Validator\Constraints as Assert;

final readonly class Login
{
    public function __construct(
        #[Assert\NotNull(groups: ['login'])]
        public string $email,

        #[Assert\NotNull(groups: ['login'])]
        public string $password,
    ) {
    }
}

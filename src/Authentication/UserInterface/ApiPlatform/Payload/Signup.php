<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\Authentication\UserInterface\ApiPlatform\Payload;

use Symfony\Component\Validator\Constraints as Assert;

final readonly class Signup
{
    public function __construct(
        #[Assert\NotNull(groups: ['signup'])]
        public string $firstName,

        #[Assert\NotNull(groups: ['signup'])]
        public string $lastName,

        #[Assert\NotNull(groups: ['signup'])]
        public string $email,

        #[Assert\NotNull(groups: ['signup'])]
        public string $password,

        #[Assert\NotNull(groups: ['signup'])]
        public string $passwordConfirm,
    ) {
    }
}

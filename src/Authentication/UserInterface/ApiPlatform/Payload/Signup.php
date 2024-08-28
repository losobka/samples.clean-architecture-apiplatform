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
        #[Assert\NotBlank(allowNull: false, groups: ['signup'])]
        public string $firstName,

        #[Assert\NotBlank(allowNull: false, groups: ['signup'])]
        public string $lastName,

        #[Assert\Email(groups: ['signup'])]
        public string $email,

        #[Assert\Length(min: 8, groups: ['signup'])]
        public string $password,

        #[Assert\IdenticalTo(propertyPath: 'password', groups: ['signup'])]
        public string $passwordConfirm,
    ) {
    }
}

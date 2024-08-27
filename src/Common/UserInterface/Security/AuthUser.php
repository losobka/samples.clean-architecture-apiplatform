<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\Common\UserInterface\Security;

use App\Authentication\Application\DTO\AuthUserDTO;
use Symfony\Component\Security\Core\User\UserInterface;

final readonly class AuthUser implements UserInterface
{
    private function __construct(
        private AuthUserDTO $authUserDTO,
    ) {
    }

    public static function fromAuthUserDTO(AuthUserDTO $authUserDTO): self
    {
        return new self($authUserDTO);
    }

    public function authUserDTO(): AuthUserDTO
    {
        return $this->authUserDTO;
    }

    public function getRoles(): array
    {
        return ['ROLE_USER'];
    }

    public function eraseCredentials(): void
    {
    }

    public function getUserIdentifier(): string
    {
        return $this->authUserDTO->userId;
    }
}

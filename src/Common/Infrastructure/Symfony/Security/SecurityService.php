<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\Common\Infrastructure\Symfony\Security;

use Override;
use App\Authentication\Application\DTO\AuthUserDTO;
use App\Common\Application\Session\Security;
use App\Common\UserInterface\Security\AuthUser;

final readonly class SecurityService implements Security
{
    public function __construct(
        private \Symfony\Bundle\SecurityBundle\Security $security,
    ) {
    }

    #[Override]
    public function isAuthenticated(): bool
    {
        return $this->connectedUser() instanceof AuthUserDTO;
    }

    #[Override]
    public function connectedUser(): ?AuthUserDTO
    {
        $authenticatedUser = $this->security->getUser();

        if (!$authenticatedUser instanceof AuthUser) {
            return null;
        }

        return $authenticatedUser->authUserDTO();
    }
}

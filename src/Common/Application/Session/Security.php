<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\Common\Application\Session;

use App\Authentication\Application\DTO\AuthUserDTO;

interface Security
{
    public function isAuthenticated(): bool;

    public function connectedUser(): ?AuthUserDTO;
}

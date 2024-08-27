<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\Authentication\Domain\Exception;

use App\Common\Domain\Exception\ValidationFailed;

final class InvalidCredentials extends ValidationFailed
{
    public function __construct()
    {
        parent::__construct('Username or password are incorrect.');
    }
}

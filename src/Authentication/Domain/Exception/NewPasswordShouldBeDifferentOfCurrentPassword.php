<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\Authentication\Domain\Exception;

use App\Common\Domain\Exception\ValidationFailed;

final class NewPasswordShouldBeDifferentOfCurrentPassword extends ValidationFailed
{
    public function __construct()
    {
        parent::__construct('The new password must be different of current password.');
    }
}

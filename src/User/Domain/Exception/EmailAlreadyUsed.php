<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\User\Domain\Exception;

use App\Common\Domain\Exception\ValidationFailed;
use App\Common\Domain\ValueObject\Email;

final class EmailAlreadyUsed extends ValidationFailed
{
    public function __construct(Email $email)
    {
        parent::__construct(sprintf('Email "%s" is already used', (string) $email));
    }
}

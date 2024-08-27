<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\Authentication\Domain\Exception;

use App\Authentication\Domain\ValueObject\Username;
use App\Common\Domain\Exception\ResourceNotFound;

final class CredentialNotFoundForUsername extends ResourceNotFound
{
    public function __construct(Username $username)
    {
        parent::__construct(sprintf('Credential not found for username "%s"', (string) $username));
    }
}

<?php

declare(strict_types=1);

namespace App\Backoffice\Authentication\Domain\Exception;

final class InvalidCredentials extends \DomainException
{
    public function __construct()
    {
        parent::__construct('Username or password are incorrect.');
    }
}

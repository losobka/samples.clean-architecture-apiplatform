<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\Messaging\Domain\Exception;

use DomainException;

final class ParticipantsIdsMissing extends DomainException
{
    public function __construct()
    {
        parent::__construct('Valid participants list must be given for create conversation.');
    }
}

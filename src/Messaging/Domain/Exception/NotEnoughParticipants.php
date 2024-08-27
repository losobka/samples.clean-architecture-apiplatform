<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\Messaging\Domain\Exception;

use DomainException;

class NotEnoughParticipants extends DomainException
{
    public function __construct(int $minParticipants, int $nbParticipantsGiven)
    {
        parent::__construct(sprintf('Not enough participants given for conversation, minimum "%d" expected and only "%d" has been given.', $minParticipants, $nbParticipantsGiven));
    }
}

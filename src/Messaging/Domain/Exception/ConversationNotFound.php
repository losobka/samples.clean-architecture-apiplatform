<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\Messaging\Domain\Exception;

use DomainException;
use App\Messaging\Domain\ValueObject\ConversationId;

final class ConversationNotFound extends DomainException
{
    public function __construct(ConversationId $conversationId)
    {
        parent::__construct(sprintf('The conversation was not found for id "%s".', (string) $conversationId));
    }
}

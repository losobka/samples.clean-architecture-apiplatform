<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\Messaging\Domain\Exception;

use DomainException;
use App\Messaging\Domain\Entity\Conversation;

final class ConversationAlreadyArchivedByParticipant extends DomainException
{
    public function __construct(Conversation $conversation)
    {
        parent::__construct(sprintf('The conversation "%s" was already archived.', (string) $conversation->id()));
    }
}

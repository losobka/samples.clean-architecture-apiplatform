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
use App\User\Domain\ValueObject\UserId;

final class UserIsAlreadyParticipantOfConversation extends DomainException
{
    public function __construct(UserId $userId, ConversationId $conversationId)
    {
        parent::__construct(sprintf('The user "%s" was already participant of conversation "%s".', (string) $userId, (string) $conversationId));
    }
}

<?php

declare(strict_types=1);

namespace App\Messaging\Domain\Exception;

use App\Backoffice\Users\Domain\ValueObject\UserId;
use App\Messaging\Domain\ValueObject\ConversationId;

final class UserIsAlreadyParticipantOfConversation extends \DomainException
{
    public function __construct(UserId $userId, ConversationId $conversationId)
    {
        parent::__construct(sprintf('The user "%s" was already participant of conversation "%s".', (string) $userId, (string) $conversationId));
    }
}

<?php

declare(strict_types=1);

namespace App\Messaging\Application\UseCase\GetConversation;

use App\Messaging\Domain\ValueObject\ConversationId;
use App\Common\Application\Query\Query;

final class GetConversationQuery implements Query
{
    public function __construct(
        public readonly ConversationId $conversationId,
    ) {
    }
}

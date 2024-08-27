<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\Messaging\Domain\Event;

use App\Common\Domain\Event\DomainEvent;

final class ConversationWasArchivedByParticipant extends DomainEvent
{
    public const EVENT_NAME = 'messaging.conversation_was_archived';

    public static function eventName(): string
    {
        return self::EVENT_NAME;
    }
}

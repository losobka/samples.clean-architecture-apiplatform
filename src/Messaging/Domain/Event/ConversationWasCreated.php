<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\Messaging\Domain\Event;

use App\Common\Domain\Event\DomainEvent;

final class ConversationWasCreated extends DomainEvent
{
    public const EVENT_NAME = 'messaging.conversation_was_created';

    public static function eventName(): string
    {
        return self::EVENT_NAME;
    }
}

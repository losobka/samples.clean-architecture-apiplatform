<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\Messaging\Application\UseCase\SendMessage;

use App\Common\Application\Command\Command;

final readonly class SendMessageCommand implements Command
{
    public function __construct(
        public string $conversationId,
        public string $messageContent,
    ) {
    }
}

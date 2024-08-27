<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\Messaging\Application\Service;

use App\Common\Application\Session\Security;
use App\Messaging\Domain\Entity\Conversation;
use App\Messaging\Domain\ValueObject\MessageContent;

final readonly class MessageCreator
{
    public function __construct(
        private Security $security,
    ) {
    }

    public function create(Conversation $conversation, MessageContent $messageContent): void
    {
        $participant = $conversation->participantFromAuthUser($this->security->connectedUser());

        $conversation->postMessage($participant, $messageContent);
    }
}

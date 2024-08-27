<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\Messaging\Application\DTO;

use App\Messaging\Domain\Entity\Message;

final readonly class MessageDTO
{
    private function __construct(
        public string $id,
        public string $content,
        public ParticipantDTO $sentBy,
        public string $sentAt,
    ) {
    }

    public static function fromEntity(Message $message): MessageDTO
    {
        return new self(
            id: (string) $message->id(),
            content: (string) $message->content(),
            sentBy: ParticipantDTO::fromEntity($message->sentBy()),
            sentAt: $message->sentAt()->toAtomString(),
        );
    }
}

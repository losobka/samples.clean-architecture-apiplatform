<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\Messaging\Domain\Entity;

use App\Messaging\Domain\ValueObject\MessageContent;
use App\Messaging\Domain\ValueObject\MessageId;
use App\Common\Domain\ValueObject\DateTime;

class Message
{
    private readonly MessageId $id;

    private function __construct(
        private readonly Conversation $conversation,
        private readonly MessageContent $content,
        private readonly DateTime $sentAt,
        private readonly Participant $sentBy,
    ) {
        $this->id = MessageId::generate();
    }

    public static function create(
        Conversation $conversation,
        MessageContent $content,
        DateTime $sentAt,
        Participant $sentBy,
    ): self {
        return new self(
            $conversation,
            $content,
            $sentAt,
            $sentBy,
        );
    }

    public function id(): MessageId
    {
        return $this->id;
    }

    public function conversation(): Conversation
    {
        return $this->conversation;
    }

    public function content(): MessageContent
    {
        return $this->content;
    }

    public function sentBy(): Participant
    {
        return $this->sentBy;
    }

    public function sentAt(): DateTime
    {
        return $this->sentAt;
    }
}

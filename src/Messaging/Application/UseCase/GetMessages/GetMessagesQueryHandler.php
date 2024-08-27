<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\Messaging\Application\UseCase\GetMessages;

use App\Common\Application\Query\QueryHandler;
use App\Messaging\Application\DTO\MessageDTO;
use App\Messaging\Domain\Entity\Message;
use App\Messaging\Domain\Repository\MessageRepository;
use App\Messaging\Domain\ValueObject\ConversationId;

final readonly class GetMessagesQueryHandler implements QueryHandler
{
    public function __construct(
        private MessageRepository $messageRepository,
    ) {
    }

    /**
     * @return MessageDTO[]
     */
    public function __invoke(GetMessagesQuery $query): array
    {
        $conversationId = ConversationId::fromString($query->conversationId);

        $messages = $this->messageRepository
            ->searchByConversationId(
                conversationId: $conversationId,
                page: $query->page,
                itemsPerPage: $query->itemsPerPage,
            );

        return $this->mapMessagesToMessagesDTOs($messages);
    }

    /**
     * @param Message[] $messages
     * @return MessageDTO[]
     */
    private function mapMessagesToMessagesDTOs(array $messages): array
    {
        return array_map(static fn(Message $message) => MessageDTO::fromEntity($message), $messages);
    }
}

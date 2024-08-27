<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\Messaging\Application\UseCase\SendMessage;

use App\Common\Application\Command\CommandHandler;
use App\Messaging\Application\Service\MessageCreator;
use App\Messaging\Domain\Repository\ConversationRepository;
use App\Messaging\Domain\ValueObject\ConversationId;
use App\Messaging\Domain\ValueObject\MessageContent;

final readonly class SendMessageCommandHandler implements CommandHandler
{
    public function __construct(
        private ConversationRepository $conversationRepository,
        private MessageCreator $messageCreator,
    ) {
    }

    public function __invoke(SendMessageCommand $command): void
    {
        $conversation = $this->conversationRepository->get(ConversationId::fromString($command->conversationId));

        $this->messageCreator->create($conversation, MessageContent::fromString($command->messageContent));
    }
}

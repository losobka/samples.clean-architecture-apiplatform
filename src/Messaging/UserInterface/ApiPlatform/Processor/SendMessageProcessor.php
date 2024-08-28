<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\Messaging\UserInterface\ApiPlatform\Processor;

use Override;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Common\Application\Command\CommandBus;
use App\Messaging\Application\UseCase\SendMessage\SendMessageCommand;
use App\Messaging\UserInterface\ApiPlatform\Resource\ConversationResource;
use App\Messaging\UserInterface\ApiPlatform\Resource\MessageResource;
use Webmozart\Assert\Assert;

final readonly class SendMessageProcessor implements ProcessorInterface
{
    public function __construct(
        private CommandBus $commandBus,
    ) {
    }

    #[Override]
    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): void
    {
        Assert::isInstanceOf($data, MessageResource::class);
        $messageResource = $data;

        /** @var ConversationResource $conversationResource */
        $conversationResource = $context['previous_data'];

        Assert::notNull($conversationResource->id);
        Assert::notNull($messageResource->content);

        $this->commandBus
            ->dispatch(
                new SendMessageCommand(
                    conversationId: $conversationResource->id,
                    messageContent: $messageResource->content,
                )
            );
    }
}

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
use App\Messaging\Application\DTO\ConversationDTO;
use App\Messaging\Application\UseCase\CreateConversation\CreateConversationCommand;
use App\Messaging\UserInterface\ApiPlatform\Resource\ConversationResource;
use Webmozart\Assert\Assert;

final readonly class CreateConversationProcessor implements ProcessorInterface
{
    public function __construct(
        private CommandBus $commandBus,
    ) {
    }

    #[Override]
    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): ConversationResource
    {
        Assert::isInstanceOf($data, ConversationResource::class);
        /** @var ConversationResource $conversationResource */
        $conversationResource = $data;

        Assert::notNull($conversationResource->participants);

        $conversationDTO = $this->createConversationAndReturnConversationDTO($conversationResource->participants);

        return ConversationResource::fromConversationDTO($conversationDTO);
    }

    private function createConversationAndReturnConversationDTO(array $participants): ConversationDTO
    {
        return $this->commandBus
            ->dispatch(
                new CreateConversationCommand(
                    members: $participants,
                )
            );
    }
}

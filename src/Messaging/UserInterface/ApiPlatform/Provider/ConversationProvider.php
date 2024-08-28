<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\Messaging\UserInterface\ApiPlatform\Provider;

use Override;
use InvalidArgumentException;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Common\Application\Query\QueryBus;
use App\Messaging\Application\DTO\ConversationDTO;
use App\Messaging\Application\UseCase\GetConversation\GetConversationQuery;
use App\Messaging\UserInterface\ApiPlatform\Resource\ConversationResource;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * @template-implements ProviderInterface<ConversationResource>
 */
final readonly class ConversationProvider implements ProviderInterface
{
    public function __construct(
        private QueryBus $queryBus,
    ) {
    }

    #[Override]
    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        try {
            $conversationId = (string) $uriVariables['id'];
            $conversationDTO = $this->getConversationById($conversationId);
        } catch (InvalidArgumentException $invalidArgumentException) {
            throw new HttpException(400, $invalidArgumentException->getMessage());
        }

        return ConversationResource::fromConversationDTO($conversationDTO);
    }

    private function getConversationById(string $conversationId): ConversationDTO
    {
        return $this->queryBus
            ->ask(
                new GetConversationQuery(
                    conversationId: $conversationId,
                )
            );
    }
}

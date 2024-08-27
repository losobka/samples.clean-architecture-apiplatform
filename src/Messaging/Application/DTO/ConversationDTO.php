<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\Messaging\Application\DTO;

use App\Messaging\Domain\Entity\Conversation;
use App\Messaging\Domain\Entity\Participant;

final readonly class ConversationDTO
{
    private function __construct(
        public string $id,
        public array $participants,
    ) {
    }

    public static function fromEntity(
        Conversation $conversation,
    ): ConversationDTO {
        $participantsDTOs = self::mapParticipantsToParticipantsDTOs($conversation->participants());

        return new self(
            id: (string) $conversation->id(),
            participants: $participantsDTOs,
        );
    }

    /**
     * @param Participant[] $participants
     * @return ParticipantDTO[]
     */
    private static function mapParticipantsToParticipantsDTOs(array $participants): array
    {
        return array_map(static fn(Participant $participant) => ParticipantDTO::fromEntity($participant), $participants);
    }
}

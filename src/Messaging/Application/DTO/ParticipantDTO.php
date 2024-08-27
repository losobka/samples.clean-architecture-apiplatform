<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\Messaging\Application\DTO;

use App\Messaging\Domain\Entity\Participant;

final readonly class ParticipantDTO
{
    private function __construct(
        public string $id,
        public string $name,
        public string $userId,
    ) {
    }

    public static function fromEntity(
        Participant $participant,
    ): ParticipantDTO {
        return new self(
            id: (string) $participant->id(),
            name: (string) $participant->name(),
            userId: (string) $participant->userId(),
        );
    }
}

<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\Messaging\Infrastructure\Doctrine\Type;

use Override;
use App\Common\Infrastructure\Doctrine\Type\UlidType;
use App\Messaging\Domain\ValueObject\ParticipantId;
use Doctrine\DBAL\Platforms\AbstractPlatform;

class ParticipantIdType extends UlidType
{
    public const TYPE = 'participant_id';

    #[Override]
    public function convertToPHPValue($value, AbstractPlatform $platform): ParticipantId
    {
        return ParticipantId::fromString((string) $value);
    }
}

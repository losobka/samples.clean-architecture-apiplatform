<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\Messaging\Infrastructure\Doctrine\Type;

use Override;
use App\Common\Infrastructure\Doctrine\Type\StringType;
use App\Messaging\Domain\ValueObject\ParticipantName;
use Doctrine\DBAL\Platforms\AbstractPlatform;

class ParticipantNameType extends StringType
{
    public const TYPE = 'participant_name';

    #[Override]
    public function convertToPHPValue($value, AbstractPlatform $platform): ParticipantName
    {
        return ParticipantName::fromString((string) $value);
    }
}

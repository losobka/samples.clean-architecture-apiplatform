<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\Messaging\Infrastructure\Doctrine\Type;

use App\Common\Infrastructure\Doctrine\Type\UlidType;
use App\Messaging\Domain\ValueObject\MessageId;
use Doctrine\DBAL\Platforms\AbstractPlatform;

class MessageIdType extends UlidType
{
    public const TYPE = 'message_id';

    public function convertToPHPValue($value, AbstractPlatform $platform): MessageId
    {
        return MessageId::fromString((string) $value);
    }
}

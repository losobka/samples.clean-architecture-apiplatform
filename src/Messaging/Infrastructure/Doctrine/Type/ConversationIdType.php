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
use App\Messaging\Domain\ValueObject\ConversationId;
use Doctrine\DBAL\Platforms\AbstractPlatform;

class ConversationIdType extends UlidType
{
    public const TYPE = 'conversation_id';

    #[Override]
    public function convertToPHPValue($value, AbstractPlatform $platform): ConversationId
    {
        return ConversationId::fromString((string) $value);
    }
}

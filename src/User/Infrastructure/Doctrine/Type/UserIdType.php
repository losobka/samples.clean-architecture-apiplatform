<?php

declare(strict_types=1);

namespace App\User\Infrastructure\Doctrine\Type;

use App\Common\Infrastructure\Doctrine\Type\UlidType;
use App\User\Domain\ValueObject\UserId;
use Doctrine\DBAL\Platforms\AbstractPlatform;

class UserIdType extends UlidType
{
    public const TYPE = 'user_id';

    public function convertToPHPValue($value, AbstractPlatform $platform): UserId
    {
        return UserId::fromString((string) $value);
    }
}

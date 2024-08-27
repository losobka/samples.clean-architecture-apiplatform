<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

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

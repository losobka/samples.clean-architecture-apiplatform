<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\Authentication\Infrastructure\Doctrine\Type;

use Override;
use App\Authentication\Domain\ValueObject\HashedPassword;
use App\Common\Infrastructure\Doctrine\Type\StringType;
use Doctrine\DBAL\Platforms\AbstractPlatform;

final class HashedPasswordType extends StringType
{
    public const TYPE = 'hashed_password';

    #[Override]
    public function convertToPHPValue($value, AbstractPlatform $platform): HashedPassword
    {
        return HashedPassword::fromString((string) $value);
    }
}

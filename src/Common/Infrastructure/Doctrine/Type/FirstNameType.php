<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\Common\Infrastructure\Doctrine\Type;

use Override;
use App\Common\Domain\ValueObject\FirstName;
use Doctrine\DBAL\Platforms\AbstractPlatform;

class FirstNameType extends StringType
{
    public const TYPE = 'firstname';

    #[Override]
    public function convertToPHPValue($value, AbstractPlatform $platform): ?FirstName
    {
        if (null === $value) {
            return null;
        }

        return FirstName::fromString((string) $value);
    }

    #[Override]
    public function getName(): string
    {
        return self::TYPE;
    }
}

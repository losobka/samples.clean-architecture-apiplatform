<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\Common\Infrastructure\Doctrine\Type;

use Override;
use App\Common\Domain\ValueObject\LastName;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class LastNameType extends StringType
{
    public const TYPE = 'lastname';

    #[Override]
    public function convertToPHPValue($value, AbstractPlatform $platform): ?LastName
    {
        if (null === $value) {
            return null;
        }

        return LastName::fromString((string) $value);
    }

    #[Override]
    public function getName(): string
    {
        return self::TYPE;
    }
}

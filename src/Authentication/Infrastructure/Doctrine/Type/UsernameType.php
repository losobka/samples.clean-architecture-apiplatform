<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\Authentication\Infrastructure\Doctrine\Type;

use Override;
use App\Authentication\Domain\ValueObject\Username;
use App\Common\Infrastructure\Doctrine\Type\StringType;
use Doctrine\DBAL\Platforms\AbstractPlatform;

final class UsernameType extends StringType
{
    public const TYPE = 'username';

    #[Override]
    public function convertToPHPValue($value, AbstractPlatform $platform): Username
    {
        return Username::fromString((string) $value);
    }
}

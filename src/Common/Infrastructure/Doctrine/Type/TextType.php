<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\Common\Infrastructure\Doctrine\Type;

use Override;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\TextType as DoctrineTextType;

abstract class TextType extends DoctrineTextType
{
    protected const TYPE = 'text';

    #[Override]
    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }

    #[Override]
    public function getName(): string
    {
        return (string) static::TYPE;
    }
}

<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\Common\Infrastructure\Doctrine\Type;

use Doctrine\DBAL\Types\DateTimeType as BaseDateTimeType;
class DateTimeType extends BaseDateTimeType
{
    protected const TYPE = 'datetime';

    public function getName(): string
    {
        return self::TYPE;
    }
}

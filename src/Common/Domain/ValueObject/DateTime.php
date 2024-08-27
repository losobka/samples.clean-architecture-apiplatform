<?php

declare(strict_types=1);

namespace App\Common\Domain\ValueObject;

use DateTime as BaseDateTime;

/**
 * @psalm-suppress MethodSignatureMismatch
 */
class DateTime extends BaseDateTime
{
    public static function now(): self
    {
        return new self();
    }
    public function toAtomString(): string
    {
        return $this->format(\DateTime::ATOM);
    }
}

<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

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
        return $this->format(BaseDateTime::ATOM);
    }

    public static function fromString(string $value): self
    {
        return new self($value);
    }
}

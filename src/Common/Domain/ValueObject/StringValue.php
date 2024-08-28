<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\Common\Domain\ValueObject;

use Override;
use Stringable;

abstract class StringValue implements Stringable
{
    protected function __construct(protected string $value)
    {
    }

    public static function fromString(string $value): static
    {
        return new static($value);
    }

    public function value(): string
    {
        return $this->value;
    }

    #[Override]
    public function __toString(): string
    {
        return $this->value();
    }

    public function isEqual(self $other): bool
    {
        return (string) $this === (string) $other;
    }
}

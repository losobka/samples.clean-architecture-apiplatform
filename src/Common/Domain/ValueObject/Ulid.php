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
use InvalidArgumentException;
use Symfony\Component\Uid\Ulid as SymfonyUlid;

class Ulid implements Stringable
{
    private function __construct(protected SymfonyUlid $value)
    {
        $this->ensureIsValidUlid($value);
    }

    public static function generate(): static
    {
        return new static(new SymfonyUlid);
    }

    public static function fromString(string $value): static
    {
        return new static(SymfonyUlid::fromString($value));
    }

    public function value(): SymfonyUlid
    {
        return $this->value;
    }

    public function equals(mixed $other): bool
    {
        return (string) $this === (string) $other;
    }

    #[Override]
    public function __toString(): string
    {
        return $this->value()->toRfc4122();
    }

    private function ensureIsValidUlid(SymfonyUlid $id): void
    {
        if (!SymfonyUlid::isValid($id->__toString())) {
            throw new InvalidArgumentException(sprintf('The uuid "%s" is not valid.', $id));
        }
    }
}

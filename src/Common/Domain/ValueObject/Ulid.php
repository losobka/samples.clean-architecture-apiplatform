<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\Common\Domain\ValueObject;

use Stringable;
use InvalidArgumentException;
use Symfony\Component\Uid\Ulid as SymfonyUlid;

abstract class Ulid implements Stringable
{
    private function __construct(protected SymfonyUlid $value)
    {
        $this->ensureIsValidUlid($value);
    }

    public static function generate(): static
    {
//        return new static(SymfonyUlid::generate());
        return new static(new SymfonyUlid);
//        return new static(RamseyUuid::uuid4()->toString());
    }

    public static function fromString(string $value): static
    {
        return new static(SymfonyUlid::fromString($value));
    }

    public function value(): string
    {
        return $this->value->toRfc4122();
    }

    public function equals(mixed $other): bool
    {
        return (string) $this === (string) $other;
    }

    public function __toString(): string
    {
        return $this->value();
    }

    private function ensureIsValidUlid(SymfonyUlid $id): void
    {
        if (!SymfonyUlid::isValid($id->__toString())) {
            throw new InvalidArgumentException(sprintf('The uuid "%s" is not valid.', $id));
        }
    }
}

<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\Common\Domain\ValueObject;

use Override;
use App\Common\Domain\Exception\InvalidFormat;

final class Email extends StringValue
{
    /**
     * @throws InvalidFormat
     */
    private function __construct(protected string $value)
    {
        $this->ensureIsValidEmail($value);

        parent::__construct($this->value);
    }

    /**
     * @throws InvalidFormat
     */
    #[Override]
    public static function fromString(string $value): static
    {
        return new self($value);
    }

    /**
     * @throws InvalidFormat
     */
    private function ensureIsValidEmail(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidFormat(sprintf('The email "%s" is not valid.', $email));
        }
    }
}

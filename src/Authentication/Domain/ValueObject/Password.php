<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\Authentication\Domain\ValueObject;

use Override;
use App\Common\Domain\Exception\InvalidFormat;
use App\Common\Domain\ValueObject\StringValue;

final class Password extends StringValue
{
    private const int MIN_LENGTH = 8;

    /**
     * @throws InvalidFormat
     */
    protected function __construct(
        string $password,
        bool $ensureIsStrength = true
    ) {
        parent::__construct($password);

        if ($ensureIsStrength) {
            $this->ensureIsStrength();
        }
    }

    #[Override]
    public static function fromString(string $value, bool $ensureIsStrength = true): static
    {
        return new self($value, $ensureIsStrength);
    }

    /**
     * @throws InvalidFormat
     */
    private function ensureIsStrength(): void
    {
        $password = $this->value;

        if (
            !$this->hasUppercaseChar($password)
            || !$this->hasLowercaseChar($password)
            || !$this->hasNumberChar($password)
            || !$this->hasSpecialChar($password)
            || !$this->hasValidLength($password)
        ) {
            throw new InvalidFormat('The password is not enough strength, should contain minimum 8 characters and should contain at least one uppercase, lowercase, number and special char');
        }
    }

    private function hasUppercaseChar(string $password): bool
    {
        return false !== preg_match('/[A-Z]/', $password);
    }

    private function hasLowercaseChar(string $password): bool
    {
        return false !== preg_match('/[a-z]/', $password);
    }

    private function hasNumberChar(string $password): bool
    {
        return false !== preg_match('/\d/', $password);
    }

    private function hasSpecialChar(string $password): bool
    {
        return false !== preg_match('/\W/', $password);
    }

    private function hasValidLength(string $password): bool
    {
        return self::MIN_LENGTH <= strlen($password);
    }
}

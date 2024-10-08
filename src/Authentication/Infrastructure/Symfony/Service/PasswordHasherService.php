<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\Authentication\Infrastructure\Symfony\Service;

use Override;
use App\Authentication\Domain\Service\PasswordHasher;
use App\Authentication\Domain\ValueObject\HashedPassword;
use App\Authentication\Domain\ValueObject\Password;
use Symfony\Component\PasswordHasher\Exception\InvalidPasswordException;
use Symfony\Component\PasswordHasher\Hasher\CheckPasswordLengthTrait;
use Symfony\Component\PasswordHasher\Hasher\NativePasswordHasher;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;

final class PasswordHasherService implements PasswordHasher
{
    use CheckPasswordLengthTrait;

    public function __construct(
        private PasswordHasherInterface $passwordHasher = new NativePasswordHasher(),
    ) {
    }

    #[Override]
    public function hash(Password $password): HashedPassword
    {
        if ($this->isPasswordTooLong((string) $password)) {
            throw new InvalidPasswordException();
        }

        return HashedPassword::fromString($this->passwordHasher->hash((string) $password));
    }

    #[Override]
    public function verify(HashedPassword $hashedPassword, Password $plainPassword): bool
    {
        return $this->passwordHasher->verify((string) $hashedPassword, (string) $plainPassword);
    }
}

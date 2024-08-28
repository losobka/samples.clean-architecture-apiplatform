<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\Authentication\Infrastructure\Symfony\Service;

use Override;
use OpenSSLAsymmetricKey;
use App\Authentication\Application\Service\TokenDecoder;
use App\Authentication\Application\Service\TokenEncoder;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

final readonly class TokenService implements TokenDecoder, TokenEncoder
{
    private const string JWT_ALGORITHM = 'RS256';

    public function __construct(
        private string $jwtPrivateKey,
        private string $jwtPublicKey,
    ) {
    }

    #[Override]
    public function decode(string $token): array
    {
        return (array) JWT::decode($token, new Key($this->getPublicKey(), self::JWT_ALGORITHM));
    }

    private function getPublicKey(): OpenSSLAsymmetricKey
    {
        return openssl_pkey_get_public('file://' . $this->jwtPublicKey);
    }

    #[Override]
    public function encode(array $payload): string
    {
        return JWT::encode($payload, $this->getPrivateKey(), self::JWT_ALGORITHM);
    }

    private function getPrivateKey(): OpenSSLAsymmetricKey
    {
        return openssl_pkey_get_private('file://' . $this->jwtPrivateKey);
    }
}

<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\Common\UserInterface\Security;

use Override;
use Exception;
use App\Authentication\Application\UseCase\GetAuthUserFromToken\GetAuthUserFromTokenQuery;
use App\Common\Application\Query\QueryBus;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

final readonly class JWTUserProvider implements UserProviderInterface
{
    public function __construct(
        private QueryBus $queryBus,
    ) {
    }

    #[Override]
    public function refreshUser(UserInterface $user): UserInterface
    {
        return $this->loadUserByIdentifier($user->getUserIdentifier());
    }

    #[Override]
    public function supportsClass(string $class): bool
    {
        return AuthUser::class === $class;
    }

    #[Override]
    public function loadUserByIdentifier(string $identifier): AuthUser
    {
        try {
            $authUserDTO = $this->queryBus
                ->ask(
                    new GetAuthUserFromTokenQuery(
                        token: $this->extractToken($identifier),
                    )
                );
        } catch (Exception $exception) {
            throw new CustomUserMessageAuthenticationException($exception->getMessage());
        }

        return AuthUser::fromAuthUserDTO($authUserDTO);
    }

    /**
     * @throws CustomUserMessageAuthenticationException
     */
    private function extractToken(string $identifier): string
    {
        $explodeAuthHeader = explode(' ', $identifier);

        if (2 !== count($explodeAuthHeader) || 'Bearer' !== $explodeAuthHeader[0]) {
            throw new CustomUserMessageAuthenticationException();
        }

        $bearerToken = $explodeAuthHeader[1];
        $explodeJwtParts = explode('.', $bearerToken);

        if (3 !== count($explodeJwtParts)) {
            throw new CustomUserMessageAuthenticationException();
        }

        return $bearerToken;
    }
}

<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\Authentication\Infrastructure\Doctrine\Repository;

use Override;
use App\Authentication\Domain\Entity\UserCredential;
use App\Authentication\Domain\Exception\CredentialNotFoundForUsername;
use App\Authentication\Domain\Repository\UserCredentialRepository;
use App\Authentication\Domain\ValueObject\Username;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @template-extends ServiceEntityRepository<UserCredential>
 */
final class DoctrineUserCredentialRepository extends ServiceEntityRepository implements UserCredentialRepository
{
    private const string ALIAS = 'user_credential';

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserCredential::class);
    }

    #[Override]
    public function getByUsername(Username $username): UserCredential
    {
        $expressionBuilder = $this->getEntityManager()->getExpressionBuilder();
        $queryBuilder = $this->createQueryBuilder(self::ALIAS);

        $queryBuilder
            ->where($expressionBuilder->eq(self::ALIAS.'.username', ':username'))
            ->setParameter('username', $username);

        /** @var ?UserCredential $userCredential */
        $userCredential = $queryBuilder->getQuery()->getOneOrNullResult();
        if (null === $userCredential) {
            throw new CredentialNotFoundForUsername($username);
        }

        return $userCredential;
    }

    #[Override]
    public function add(UserCredential $userCredential): void
    {
        $this->getEntityManager()->persist($userCredential);
    }
}

<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\Messaging\Infrastructure\Doctrine\Repository;

use Override;
use App\Messaging\Domain\Entity\Conversation;
use App\Messaging\Domain\Exception\ConversationNotFound;
use App\Messaging\Domain\Repository\ConversationRepository;
use App\Messaging\Domain\ValueObject\ConversationId;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\OrderBy;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @template-extends ServiceEntityRepository<Conversation>
 */
class DoctrineConversationRepository extends ServiceEntityRepository implements ConversationRepository
{
    public const ALIAS = 'conversation';

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Conversation::class);
    }

    #[Override]
    public function add(Conversation $conversation): void
    {
        $this->getEntityManager()->persist($conversation);
    }

    #[Override]
    public function remove(Conversation $conversation): void
    {
        $this->getEntityManager()->remove($conversation);
    }

    /**
     * @throws ConversationNotFound
     */
    #[Override]
    public function get(ConversationId $conversationId): Conversation
    {
        /** @var ?Conversation $conversation */
        $conversation = $this->find($conversationId);
        if (null === $conversation) {
            throw new ConversationNotFound($conversationId);
        }

        return $conversation;
    }

    #[Override]
    public function search(int $pageNumber, int $itemsPerPage): array
    {
        $queryBuilder = $this->createQueryBuilder(self::ALIAS);

        $queryBuilder
            ->setFirstResult(($pageNumber - 1) * $itemsPerPage)
            ->setMaxResults($itemsPerPage)
            ->orderBy(new OrderBy(self::ALIAS . '.createdAt'));

        return $queryBuilder->getQuery()->getResult();
    }
}

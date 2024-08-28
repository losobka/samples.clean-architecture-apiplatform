<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\Common\Infrastructure\Symfony\Messenger;

use Override;
use Throwable;
use App\Common\Application\Query\QueryBus;
use App\Common\Application\Query\Query;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

final class MessengerQueryBus implements QueryBus
{
    use HandleTrait;

    public function __construct(MessageBusInterface $queryBus)
    {
        $this->messageBus = $queryBus;
    }

    #[Override]
    public function ask(Query $query): mixed
    {
        try {
            return $this->handle($query);
        } catch (HandlerFailedException $handlerFailedException) {
            /** @var array{0: Throwable} $exceptions */
            $exceptions = $handlerFailedException->getWrappedExceptions();

            throw current($exceptions);
        }
    }
}

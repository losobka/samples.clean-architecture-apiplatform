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
use App\Common\Application\Command\CommandBus;
use App\Common\Application\Command\Command;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

final class MessengerCommandBus implements CommandBus
{
    use HandleTrait;

    public function __construct(MessageBusInterface $commandBus)
    {
        $this->messageBus = $commandBus;
    }

    /**
     * @throws Throwable
     */
    #[Override]
    public function dispatch(Command $command): mixed
    {
        try {
            return $this->handle($command);
        } catch (HandlerFailedException $handlerFailedException) {
            /** @var array{0: Throwable} $exceptions */
            $exceptions = $handlerFailedException->getWrappedExceptions();

            throw current($exceptions);
        }
    }
}

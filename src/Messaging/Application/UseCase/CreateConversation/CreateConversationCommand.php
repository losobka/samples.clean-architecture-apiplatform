<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\Messaging\Application\UseCase\CreateConversation;

use App\Common\Application\Command\Command;

final readonly class CreateConversationCommand implements Command
{
    public function __construct(
        private array $members = [],
    ) {
    }

    public function members(): array
    {
        return $this->members;
    }
}

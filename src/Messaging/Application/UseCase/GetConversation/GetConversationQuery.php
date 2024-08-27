<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\Messaging\Application\UseCase\GetConversation;

use App\Common\Application\Query\Query;

final readonly class GetConversationQuery implements Query
{
    public function __construct(
        public string $conversationId,
    ) {
    }
}

<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\Messaging\Application\UseCase\GetMessages;

use App\Common\Application\Query\Query;

final readonly class GetMessagesQuery implements Query
{
    public function __construct(
        public string $conversationId,
        public int $page = 1,
        public int $itemsPerPage = 20,
    ) {
    }
}

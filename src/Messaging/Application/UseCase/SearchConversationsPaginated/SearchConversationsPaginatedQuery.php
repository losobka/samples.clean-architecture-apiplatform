<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\Messaging\Application\UseCase\SearchConversationsPaginated;

use App\Common\Application\Query\Query;

final readonly class SearchConversationsPaginatedQuery implements Query
{
    public function __construct(
        public int $page = 1,
        public int $itemsPerPage = 20,
    ) {
    }
}

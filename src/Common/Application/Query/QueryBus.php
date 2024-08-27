<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\Common\Application\Query;

interface QueryBus
{
    public function ask(Query $query): mixed;
}

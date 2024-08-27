<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\Common\Application\Command;

interface CommandBus
{
    public function dispatch(Command $command): mixed;
}

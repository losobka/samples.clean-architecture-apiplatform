<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\Common\Domain\Event;

interface EventBus
{
    public function publish(DomainEvent ...$events): void;
}

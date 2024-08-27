<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\Authentication\Application\Service;

interface TokenDecoder
{
    public function decode(string $token): array;
}

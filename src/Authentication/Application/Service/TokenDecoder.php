<?php

declare(strict_types=1);

namespace App\Authentication\Application\Service;

interface TokenDecoder
{
    public function decode(string $token): array;
}

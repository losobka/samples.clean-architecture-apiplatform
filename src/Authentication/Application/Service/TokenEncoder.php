<?php

declare(strict_types=1);

namespace App\Authentication\Application\Service;

interface TokenEncoder
{
    public function encode(array $payload): string;
}

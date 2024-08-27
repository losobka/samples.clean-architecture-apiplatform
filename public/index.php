<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

use App\Common\Infrastructure\Symfony\Kernel;

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

return fn(array $context) => new Kernel((string) $context['APP_ENV'], (bool) $context['APP_DEBUG']);

<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

if (file_exists(dirname(__DIR__).'/var/cache/prod/App_KernelProdContainer.preload.php')) {
    opcache_compile_file(dirname(__DIR__) . '/var/cache/prod/App_KernelProdContainer.preload.php');
}

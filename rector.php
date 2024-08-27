<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Symfony\Set\SymfonySetList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths([
        __DIR__ . '/src',
        __DIR__ . '/tests',
        __DIR__ . '/migrations',
        __DIR__ . '/public',
    ]);

    $rectorConfig->sets([
        LevelSetList::UP_TO_PHP_82,
        LevelSetList::UP_TO_PHP_83,
        SymfonySetList::SYMFONY_62,
        SymfonySetList::SYMFONY_63,
        SymfonySetList::SYMFONY_64,
        SymfonySetList::SYMFONY_70,
        SymfonySetList::SYMFONY_71
    ]);

    $rectorConfig->importNames();
    $rectorConfig->removeUnusedImports();
};

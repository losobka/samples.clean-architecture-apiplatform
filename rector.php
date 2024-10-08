<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Php82\Rector\Class_\ReadOnlyClassRector;
use Rector\PHPUnit\Set\PHPUnitSetList;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Set\ValueObject\SetList;
use Rector\Symfony\Set\SymfonySetList;
use Rector\TypeDeclaration\Rector\StmtsAwareInterface\DeclareStrictTypesRector;
use Rector\ValueObject\PhpVersion;

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
        SetList::CODING_STYLE,
        SetList::CODE_QUALITY,
        SetList::PHP_82,
        SetList::PHP_82,
        SetList::PHP_83,
        SetList::DEAD_CODE,
        SymfonySetList::SYMFONY_62,
        SymfonySetList::SYMFONY_63,
        SymfonySetList::SYMFONY_64,
        SymfonySetList::SYMFONY_70,
        SymfonySetList::SYMFONY_71,
        PHPUnitSetList::PHPUNIT_100,
    ]);

    $rectorConfig->phpVersion(PhpVersion::PHP_83);

    $rectorConfig->rule(DeclareStrictTypesRector::class);
    $rectorConfig->skip([
        ReadOnlyClassRector::class
    ]);

    $rectorConfig->importNames();
    $rectorConfig->removeUnusedImports();
};

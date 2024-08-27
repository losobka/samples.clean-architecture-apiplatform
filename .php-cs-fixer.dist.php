<?php

$finder = (new PhpCsFixer\Finder)
    ->in(['config', 'src', 'tests', 'migrations', 'public'])
    ->exclude(__DIR__  . DIRECTORY_SEPARATOR . 'var' . DIRECTORY_SEPARATOR . 'cache')
    ->exclude(__DIR__  . DIRECTORY_SEPARATOR . 'vendor')
;

$config = (new PhpCsFixer\Config)
    ->setRules([
        'yoda_style' => [
            'equal' => true,
            'identical' => true,
            'less_and_greater' => true,
        ],
        'header_comment' => [
            'header' => "webapp.api\n\n(c) 2024 Łukasz Osóbka"
        ],
    ])
    ->setFinder($finder)
    ->setUsingCache(false)
;

return $config;

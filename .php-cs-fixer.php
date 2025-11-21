<?php

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__)
    ->exclude([
        '.*',
        'tests',
        'vendor',
        'storage',
        'infra',
        'public',
        'bootstrap/cache',
    ]);

return (new PhpCsFixer\Config())
    ->setRules([
        '@PSR12' => true,
    ])
    ->setFinder($finder);

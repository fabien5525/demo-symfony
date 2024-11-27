<?php

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__.'/src')
    ->in(__DIR__.'/tests')
    ->in(__DIR__.'/public')
    ->in(__DIR__.'/config')
    ->in(__DIR__.'/bin')
;

return (new PhpCsFixer\Config())
    ->setRules([
        '@Symfony' => true,
    ])
    ->setFinder($finder)
;

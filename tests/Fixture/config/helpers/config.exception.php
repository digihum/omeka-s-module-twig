<?php

return [
    'service_manager' => [
        'factories' => [
            \OmekaTwig\Test\Fixture\DummyClass::class => \Zend\ServiceManager\Factory\InvokableFactory::class,
        ],
    ],
    'view_manager' => [
        'template_path_stack'     => [
            'OmekaTwig' => __DIR__ . '/../../view/OmekaTwig',
        ],
        'default_template_suffix' => \OmekaTwig\Service\TwigLoaderFactory::DEFAULT_SUFFIX,
    ],
    'omeka_twig'       => [
        'helpers' => [
            'configs' => [
                \Zend\Navigation\View\HelperConfig::class,
                \OmekaTwig\Test\Fixture\DummyClass::class,
            ],
        ],
    ],
];

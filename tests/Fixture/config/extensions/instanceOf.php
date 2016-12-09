<?php

use OmekaTwig\Service\TwigLoaderFactory;
use OmekaTwig\Test\Fixture\Extension\InstanceOfExtension;

return [
    'view_manager'    => [
        'template_path_stack'     => [
            'OmekaTwig' => __DIR__ . '/../../view/OmekaTwig',
        ],
        'default_template_suffix' => TwigLoaderFactory::DEFAULT_SUFFIX,
    ],
    'service_manager' => [
        'factories' => [
            InstanceOfExtension::class => \OmekaTwig\Service\TwigExtensionFactory::class,
        ],
    ],
    'omeka_twig'       => [
        'extensions' => [
            InstanceOfExtension::class,
        ],
    ],
];

<?php

return [
    'service_manager' => [
        'factories' => [
            \OmekaTwig\Test\Fixture\Extension\DummyExtension::class => \OmekaTwig\Service\TwigExtensionFactory::class,
        ],
    ],
    'omeka_twig'       => [
        'extensions' => [
            \OmekaTwig\Test\Fixture\Extension\DummyExtension::class,
        ],
    ],
];

<?php

return [
    'view_manager' => [
        'template_path_stack'     => [
            'OmekaTwig' => __DIR__ . '/../../view/OmekaTwig',
        ],
        'default_template_suffix' => \OmekaTwig\Service\TwigLoaderFactory::DEFAULT_SUFFIX,
    ],
    'omeka_twig'       => [
        'extensions'   => [
            123123,
        ],
    ],
];

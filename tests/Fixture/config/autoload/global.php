<?php

return [
    'view_manager' => [
        'doctype'                 => \Zend\View\Helper\Doctype::HTML5,
        'template_map' => array (
            'layout' => __DIR__ . '/../../view/Map/layout.twig',
        ),
        'template_path_stack'     => [
            'OmekaTwig' => __DIR__ . '/../../view/OmekaTwig',
        ],
        'default_template_suffix' => \OmekaTwig\Service\TwigLoaderFactory::DEFAULT_SUFFIX,
    ],
];

<?php

return [
    'modules' => [
        'OmekaTwig',
    ],
    'view_manager' => [
        'strategies' => [
            OmekaTwig\View\TwigStrategy::class,
        ],
    ],
    // 'listeners' => [
    //     'OmekaTwig\View\TwigStrategy',
    // ],
    'service_manager' => [
        'factories' => [
            \OmekaTwig\View\TwigStrategy::class => \OmekaTwig\Service\TwigStrategyFactory::class,
            \OmekaTwig\View\HelperPluginManager::class => \OmekaTwig\Service\TwigHelperPluginManagerFactory::class,
            \OmekaTwig\Renderer\TwigRenderer::class => \OmekaTwig\Service\TwigRendererFactory::class,
            \OmekaTwig\Resolver\TwigResolver::class => \OmekaTwig\Service\TwigResolverFactory::class,
            \Twig_Environment::class => \OmekaTwig\Service\TwigEnvironmentFactory::class,
            \Twig_Loader_Chain::class => \OmekaTwig\Service\TwigLoaderFactory::class,
            \OmekaTwig\Loader\MapLoader::class => \OmekaTwig\Service\TwigMapLoaderFactory::class,
            \OmekaTwig\Loader\StackLoader::class => \OmekaTwig\Service\TwigStackLoaderFactory::class,
        ],
    ],
    'omeka_twig' => [
        /**
         * In a ZF3 by default we have this structure:
         *  - ViewModel with template from 'layout/layout'
         *  - ViewModel as child with action template 'application/index/index'
         * In that case we should always force standalone state of child models
         */
        'force_standalone' => true,
        /**
         * Developer can disable Zend View Helpers like docType, translate and e.t.c.
         */
        'invoke_zend_helpers' => true,
        /**
         * Twig Environment settings
         */
        'environment' => [
        ],
        /**
         * Default loaders for views
         */
        'loader_chain' => [
            \OmekaTwig\Loader\MapLoader::class,
            \OmekaTwig\Loader\StackLoader::class,
        ],
        /**
         * List of Twig Extensions
         */
        'extensions' => [
            \OmekaTwig\Extension\Extension::class,
        ],
        'helpers' => [
            'configs' => [
                \Zend\Navigation\View\HelperConfig::class,
            ],
        ],
    ],
];

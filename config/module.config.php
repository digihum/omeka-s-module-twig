<?php

return [
    'modules' => [
        'ThemeTwig',
    ],
    'view_manager' => [
        'strategies' => [
            ThemeTwig\View\TwigStrategy::class,
        ],
    ],
     'listeners' => [
        'ThemeTwig\View\TwigStrategy',
    ],
    'service_manager' => [
        'factories' => [
            \ThemeTwig\View\TwigStrategy::class => \ThemeTwig\Service\TwigStrategyFactory::class,
            \ThemeTwig\View\HelperPluginManager::class => \ThemeTwig\Service\TwigHelperPluginManagerFactory::class,
            \ThemeTwig\Renderer\TwigRenderer::class => \ThemeTwig\Service\TwigRendererFactory::class,
            \ThemeTwig\Resolver\TwigResolver::class => \ThemeTwig\Service\TwigResolverFactory::class,
            \Twig\Environment::class => \ThemeTwig\Service\TwigEnvironmentFactory::class,
            \Twig\Loader\ChainLoader::class => \ThemeTwig\Service\TwigLoaderFactory::class,
            \ThemeTwig\Loader\MapLoader::class => \ThemeTwig\Service\TwigMapLoaderFactory::class,
            \ThemeTwig\Loader\StackLoader::class => \ThemeTwig\Service\TwigStackLoaderFactory::class,
            \ThemeTwig\Extension\Extension::class => \ThemeTwig\Service\TwigExtensionFactory::class
        ],
    ],
    'theme_twig' => [
        'suffix' => \ThemeTwig\Service\TwigLoaderFactory::DEFAULT_SUFFIX,
        /**
         * In a ZF3 by default we have this structure:
         *  - ViewModel with template from 'layout/layout'
         *  - ViewModel as child with action template 'application/index/index'
         * In that case we should always force standalone state of child models
         */
        'force_standalone' => true,
        /**
         * Force Your application to use TwigRender for ViewModel.
         * If false, then TwigStrategy will be applied only for TwigModel
         *
         * @note: In release v.1.5 this parameter will be set to false
         */
        'force_twig_strategy' => false,
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
            \ThemeTwig\Loader\MapLoader::class,
            \ThemeTwig\Loader\StackLoader::class,
        ],
        /**
         * List of Twig Extensions
         */
        'extensions' => [
            \ThemeTwig\Extension\Extension::class,
        ],
        'helpers' => [
            'configs' => [
                \Laminas\Navigation\View\HelperConfig::class,
            ],
        ],
    ],
];

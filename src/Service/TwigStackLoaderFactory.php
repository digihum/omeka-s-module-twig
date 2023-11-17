<?php

namespace ThemeTwig\Service;

use ThemeTwig\Loader\StackLoader;
use ThemeTwig\Module;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class TwigStackLoaderFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string             $requestedName
     * @param array|null         $options
     *
     * @return \ThemeTwig\Loader\StackLoader
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) : StackLoader
    {
        $config  = $container->get('Configuration');
        $name    = Module::MODULE_NAME;
        $options = $envOptions = empty($config[$name]) ? [] : $config[$name];
        $suffix  = empty($options['suffix']) ? TwigLoaderFactory::DEFAULT_SUFFIX : $options['suffix'];

        /** @var \Laminas\View\Resolver\TemplatePathStack $zfStack */
        $zfStack = $container->get('ViewTemplatePathStack');
        echo "<pre>";
        //print_r($zfStack);
        echo "</pre>";
        $loader = new StackLoader($zfStack->getPaths()->toArray());
        $loader->setSuffix($suffix);

        return $loader;
    }
}
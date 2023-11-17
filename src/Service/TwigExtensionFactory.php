<?php

namespace ThemeTwig\Service;

use ThemeTwig\Renderer\TwigRenderer;
use ThemeTwig\Extension\Extension;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class TwigExtensionFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string             $requestedName
     * @param array|null         $options
     *
     * @return Extension
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) : Extension
    {
        return new $requestedName($container, $container->get(TwigRenderer::class));
    }
}
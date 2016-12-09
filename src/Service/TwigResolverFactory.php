<?php
namespace OmekaTwig\Service;

use OmekaTwig\Resolver\TwigResolver;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class TwigResolverFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string             $requestedName
     * @param array|null         $options
     *
     * @return TwigResolver
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new TwigResolver($container->get('Twig_Environment'));
    }
}

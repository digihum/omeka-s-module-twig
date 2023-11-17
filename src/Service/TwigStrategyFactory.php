<?php
namespace ThemeTwig\Service;

use ThemeTwig\Module;
use ThemeTwig\Renderer\TwigRenderer;
use ThemeTwig\View\TwigStrategy;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class TwigStrategyFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string             $requestedName
     * @param array|null         $options
     *
     * @return TwigStrategy
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) : TwigStrategy
    {
        $config      = $container->get('Configuration');
        $name        = Module::MODULE_NAME;
        $options     = $envOptions = empty($config[$name]) ? [] : $config[$name];

        /**
         * @var \ZendTwig\Renderer\TwigRenderer $renderer
         */
        $renderer = $container->get(TwigRenderer::class);
        $strategy = new TwigStrategy($renderer);

        $forceStrategy = !empty($options['force_twig_strategy']);
        $strategy->setForceRender($forceStrategy);

        return $strategy;
    }
}
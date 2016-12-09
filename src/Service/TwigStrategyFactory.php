<?php
namespace OmekaTwig\Service;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Zend\View\Strategy\PhpRendererStrategy;
use OmekaTwig\View\TwigStrategy;

class TwigStrategyFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string             $requestedName
     * @param array|null         $options
     *
     * @return TwigStrategy
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /**
         * @var \OmekaTwig\Renderer\TwigRenderer $renderer
         * @var \Zend\View\View $view
         */
        //$renderer = $container->get('OmekaTwig\Renderer\TwigRenderer');
        $strategy = new TwigStrategy();

        return $strategy;
    }
}

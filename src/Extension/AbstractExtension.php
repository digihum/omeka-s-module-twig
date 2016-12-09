<?php

namespace OmekaTwig\Extension;

use Twig_Extension;
use Interop\Container\ContainerInterface;
use OmekaTwig\Renderer\TwigRenderer;

abstract class AbstractExtension extends Twig_Extension
{
    /**
     * @var \OmekaTwig\Renderer\TwigRenderer
     */
    protected $renderer;

    /**
     * @var \Interop\Container\ContainerInterface
     */
    protected $serviceManager;

    /**
     * @param \Interop\Container\ContainerInterface $serviceManager
     * @param \OmekaTwig\Renderer\TwigRenderer       $renderer
     */
    public function __construct(ContainerInterface $serviceManager, TwigRenderer $renderer = null)
    {
        $this->serviceManager = $serviceManager;
        $this->renderer       = $renderer;
    }

    /**
     * @return \OmekaTwig\Renderer\TwigRenderer
     */
    abstract public function getRenderer();

    /**
     * @return \Interop\Container\ContainerInterface
     */
    abstract public function getServiceManager();
}

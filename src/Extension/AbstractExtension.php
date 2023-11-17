<?php

namespace ThemeTwig\Extension;


use Interop\Container\ContainerInterface;
use ThemeTwig\Renderer\TwigRenderer;

abstract class AbstractExtension extends \Twig\Extension\AbstractExtension
{
    /**
     * @var \ThemeTwig\Renderer\TwigRenderer
     */
    protected $renderer;

    /**
     * @var \Interop\Container\ContainerInterface
     */
    protected $serviceManager;

    /**
     * @param \Interop\Container\ContainerInterface $serviceManager
     * @param \ThemeTwig\Renderer\TwigRenderer       $renderer
     */
    public function __construct(ContainerInterface $serviceManager, TwigRenderer $renderer = null)
    {
        $this->serviceManager = $serviceManager;
        $this->renderer       = $renderer;
    }

    /**
     * @return \ThemeTwig\Renderer\TwigRenderer
     */
    abstract public function getRenderer();

    /**
     * @return \Interop\Container\ContainerInterface
     */
    abstract public function getServiceManager();
}

<?php

namespace ThemeTwig\Extension;

class Extension extends AbstractExtension
{
    /**
     * @return \ThemeTwig\Renderer\TwigRenderer
     */
    public function getRenderer()
    {
        return $this->renderer;
    }

    /**
     * @return \Interop\Container\ContainerInterface
     */
    public function getServiceManager()
    {
        return $this->serviceManager;
    }
}

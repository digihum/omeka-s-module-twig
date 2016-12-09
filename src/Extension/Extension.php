<?php

namespace OmekaTwig\Extension;

class Extension extends AbstractExtension
{
    /**
     * @return \OmekaTwig\Renderer\TwigRenderer
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

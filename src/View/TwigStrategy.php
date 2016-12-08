<?php

namespace ZendTwig\View;

use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\AbstractListenerAggregate;
use Zend\EventManager\ListenerAggregateTrait;
use Zend\View\Renderer\RendererInterface;
use Zend\View\ViewEvent;
use Zend\Mvc\MvcEvent;
use Zend\EventManager\EventManager;

class TwigStrategy extends AbstractListenerAggregate
{
    use ListenerAggregateTrait;

    /**
     * @var \Zend\View\Renderer\RendererInterface
     */
    protected $renderer;

    public function __construct()
    {
        $this->renderer = NULL;
    }

    // public function __construct(RendererInterface $renderer)
    // {
    //     $this->renderer = $renderer;
    // }

    /**
     * Attach one or more listeners
     *
     * Implementors may add an optional $priority argument; the EventManager
     * implementation will pass this to the aggregate.
     *
     * @param EventManagerInterface $events
     * @param int                   $priority
     *
     * @return void
     */
    public function attach(EventManagerInterface $events, $priority = 1)
    {
        $this->listeners[] = $events->attach(ViewEvent::EVENT_RENDERER, [$this, 'selectRender'], $priority);
        $this->listeners[] = $events->attach(ViewEvent::EVENT_RESPONSE, [$this, 'injectResponse'], $priority);
        // $this->listeners[] = $events->attach(MvcEvent::EVENT_ROUTE,
        //     [$this, 'pathsUpdated'], -10000
        // );
    }

    public function setRenderer(RendererInterface $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * @param \Zend\View\ViewEvent $e
     *
     * @return \Zend\View\Renderer\RendererInterface
     */
    // public function pathsUpdated(MvcEvent $event)
    // {
    //     $services = $event->getApplication()->getServiceManager();
    //     $paths = $services->get('ViewTemplatePathStack')->getPaths()->toArray();
    //     $loader = $services->get('Twig_Loader_Chain');
    //     $this->renderer->setLoader($loader);
    // }


    /**
     * @param \Zend\View\ViewEvent $e
     *
     * @return \Zend\View\Renderer\RendererInterface
     */
    public function selectRender(ViewEvent $e)
    {
        if($this->renderer !== NULL && $this->renderer->canRender($e->getModel()->getTemplate())) {
            $eventManager = $e->getTarget()->getEventManager();
            $this->renderer->setEventManager($eventManager);
            return $this->renderer;
        } else {
            return NULL;
        }   
    }

    /**
     * @param \Zend\View\ViewEvent $e
     */
    public function injectResponse(ViewEvent $e)
    {
        if ($this->renderer === NULL || $this->renderer !== $e->getRenderer()) {
            return;
        }

        $result   = $e->getResult();
        $response = $e->getResponse();

        $response->setContent($result);
    }
}

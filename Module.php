<?php
namespace ThemeTwig;

use Omeka\Module\AbstractModule;
use Twig\Environment;
use Laminas\EventManager\EventInterface;
use Laminas\ModuleManager\Feature\BootstrapListenerInterface;
use Laminas\ModuleManager\Feature\ConfigProviderInterface;
use Laminas\View\Exception\InvalidArgumentException;
use ThemeTwig\Renderer\TwigRenderer;
use Laminas\ModuleManager\ModuleManager;

class Module extends AbstractModule implements ConfigProviderInterface, BootstrapListenerInterface
{
    const MODULE_NAME = 'theme_twig';

    /**
     * Listen to the bootstrap event
     *
     * @param \Laminas\Mvc\MvcEvent|EventInterface $e
     *
     * @return array|void
     */

     public function init(ModuleManager $moduleManager): void
     {
         require_once __DIR__ . '/vendor/autoload.php';
     }
 
    public function onBootstrap(EventInterface $e)
    {
        
        $services = $e->getApplication()->getServiceManager();
        $config = $services->get('Config');

        //$services->get('ViewTemplatePathStack')->addPath("/opt/omeka-s/build/html/themes/freedom/view/");



        /**
         * @var Environment $env
         */
        $config      = $services->get('Configuration');
        $env         = $services->get(Environment::class);
        $name        = static::MODULE_NAME;
        $options     = $envOptions = empty($config[$name]) ? [] : $config[$name];
        $extensions  = empty($options['extensions']) ? [] : $options['extensions'];
        $renderer    = $services->get(TwigRenderer::class);

        // Setup extensions
        foreach ($extensions as $extension) {
            // Allows modules to override/remove extensions.
            if (empty($extension)) {
                continue;
            } elseif (is_string($extension)) {
                if ($services->has($extension)) {
                    $extension = $services->get($extension);
                } else {
                    $extension = new $extension($services, $renderer);
                }
            } elseif (!is_object($extension)) {
                throw new InvalidArgumentException('Extensions should be a string or object.');
            }

            if (!$env->hasExtension(get_class($extension))) {
                $env->addExtension($extension);
            }
        }

        return;
    }

    /**
     * Returns configuration to merge with application configuration
     *
     * @return array|\Traversable
     */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
}
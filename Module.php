<?php
namespace ThemeTwig;

require __DIR__ . '/vendor/autoload.php';

use Twig\Environment;
use Laminas\EventManager\EventInterface;
use Laminas\View\Exception\InvalidArgumentException;
use ThemeTwig\Renderer\TwigRenderer;
use Laminas\Mvc\MvcEvent;
use \Omeka\Module\AbstractModule;

class Module extends AbstractModule 
{
    const MODULE_NAME = 'theme_twig';


    public function onBootstrap(MvcEvent $e)
    {
        $app       = $e->getApplication();
        $container = $app->getServiceManager();

        //$currentTheme =  $container->get('Omeka\Site\ThemeManager')->getTheme('freedom');
        // Add the theme view templates to the path stack.
        //echo "<pre>Hello theme:";
        //print_r($container->get('Omeka\Site\ThemeManager'));
        $container->get('ViewTemplatePathStack')->addPath("/opt/omeka-s/build/html/modules/ZoteroImport/view/");
        //echo "</pre>";

        /**
         * @var Environment $env
         */
        $config      = $container->get('Configuration');
        $env         = $container->get(Environment::class);
        $name        = static::MODULE_NAME;
        $options     = $envOptions = empty($config[$name]) ? [] : $config[$name];
        $extensions  = empty($options['extensions']) ? [] : $options['extensions'];
        $renderer    = $container->get(TwigRenderer::class);

        // Setup extensions
        foreach ($extensions as $extension) {
            // Allows modules to override/remove extensions.
            if (empty($extension)) {
                continue;
            } elseif (is_string($extension)) {
                if ($container->has($extension)) {
                    $extension = $container->get($extension);
                } else {
                    $extension = new $extension($container, $renderer);
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

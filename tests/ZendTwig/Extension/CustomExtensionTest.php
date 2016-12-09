<?php

namespace OmekaTwig\Test\Extension;

use PHPUnit_Framework_TestCase as TestCase;
use Zend\Mvc\MvcEvent;
use OmekaTwig\Extension\Extension;
use OmekaTwig\Module;
use OmekaTwig\Test\Bootstrap;
use OmekaTwig\Test\Fixture\DummyClass;
use OmekaTwig\Test\Fixture\Extension\InstanceOfExtension;
use OmekaTwig\View\TwigStrategy;

class CustomExtensionTest extends TestCase
{
    public function testExtensionFactory()
    {
        $config = include(__DIR__ . '/../../Fixture/config/application.config.php');
        $config['module_listener_options']['config_glob_paths'] = [
            realpath(__DIR__) . '/../../Fixture/config/extensions/{{,*.}instanceOf}.php',
        ];

        /**
         * @var \OmekaTwig\Test\Fixture\Extension\InstanceOfExtension $extension
         */
        $sm = Bootstrap::getInstance($config)->getServiceManager();
        $extension = $sm->get(InstanceOfExtension::class);

        $exRender = $extension->getRenderer();
        $exSm     = $extension->getServiceManager();

        $this->assertInstanceOf('\OmekaTwig\Renderer\TwigRenderer', $exRender);
        $this->assertInstanceOf('\Interop\Container\ContainerInterface', $exSm);
        $this->assertSame($sm, $exSm);
    }

    public function testExtensionConstruct()
    {
        /**
         * @var \OmekaTwig\Extension\Extension $extension
         */
        $sm        = Bootstrap::getInstance()->getServiceManager();
        $renderer  = $sm->get(\OmekaTwig\Renderer\TwigRenderer::class);
        $extension = new Extension($sm, $renderer);

        $exRender = $extension->getRenderer();
        $exSm     = $extension->getServiceManager();

        $this->assertInstanceOf('\OmekaTwig\Renderer\TwigRenderer', $exRender);
        $this->assertInstanceOf('\Interop\Container\ContainerInterface', $exSm);

        $this->assertSame($sm, $exSm);
        $this->assertSame($renderer, $exRender);
    }

    /**
     * @dataProvider generatorFallbackToZendHelpers
     *
     * @param array  $vars
     * @param string $expected
     */
    public function testExtension($vars, $expected)
    {
        $config = include(__DIR__ . '/../../Fixture/config/application.config.php');
        $config['module_listener_options']['config_glob_paths'] = [
            realpath(__DIR__) . '/../../Fixture/config/extensions/{{,*.}instanceOf}.php',
        ];

        $model = new \Zend\View\Model\ViewModel($vars);
        $model->setTemplate('Extensions/InstanceOf');

        $e = new MvcEvent();
        $e->setApplication(Bootstrap::getInstance($config)->getApplication());

        $module = new Module();
        $module->onBootstrap($e);

        /**
         * @var \Zend\View\View $view
         */
        $sm           = Bootstrap::getInstance($config)->getServiceManager();
        $strategyTwig = $sm->get(TwigStrategy::class);
        $view         = $sm->get('View');
        $request      = $sm->get('Request');
        $response     = $sm->get('Response');

        $e = $view->getEventManager();
        $strategyTwig->attach($e, 100);

        $view->setEventManager($e)
            ->setRequest($request)
            ->setResponse($response)
            ->render($model);

        $result = $view->getResponse()
            ->getContent();

        $this->assertEquals($expected, $result);
    }

    /**
     * @return array
     */
    public function generatorFallbackToZendHelpers()
    {
        return [
            [
                [
                 'varClass' => new DummyClass(),
                 'varInstance' => DummyClass::class,
                ],
                "<span>Yes</span>\n"
            ],
            [
                [
                    'varClass' => new DummyClass(),
                    'varInstance' => \OmekaTwig\Module::class,
                ],
                "<span>No</span>\n"
            ],
        ];
    }
}

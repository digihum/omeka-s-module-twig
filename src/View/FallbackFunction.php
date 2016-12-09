<?php

namespace OmekaTwig\View;

use Twig_SimpleFunction;
use Zend\View\Helper\HelperInterface;
use OmekaTwig\Module;

class FallbackFunction extends Twig_SimpleFunction
{
    /**
     * @param       $name
     * @param       $callable
     * @param array $options
     */
    public function __construct($name, $callable = null, array $options = [])
    {
        $options = [
            'needs_environment' => true,
            'is_safe'           => ['all'],
        ];

        /**
         * Create callback function for injection of Zend View Helpers
         *
         * @param       $env
         * @param array ...$args
         *
         * @return mixed
         */
        $callable = function ($env, ... $args) {
            $plugin = $env->getExtension('\OmekaTwig\Extension\Extension')
                          ->getRenderer()
                          ->plugin($this->name);

            $args = empty($args) ? [] : $args;

            return call_user_func_array($plugin, $args);
        };

        parent::__construct($name, $callable, $options);
    }
}

<?php

namespace OmekaTwig\Test\Fixture\Extension;

use OmekaTwig\Extension\Extension;

class InstanceOfExtension extends Extension
{
    public function getFunctions()
    {
        return [
            'isInstanceOf' => new \Twig_Function_Method($this, 'isInstanceOf'),
        ];
    }

    /**
     *  Is instance of ...
     *
     * @param string $class
     * @param string $className
     *
     * @return bool
     */
    public function isInstanceOf($class = '', $className = '')
    {
        $reflectionClass = new \ReflectionClass($class);

        return $reflectionClass->isInstance(new $className());
    }
}

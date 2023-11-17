<?php

namespace ThemeTwig\Loader;

use Twig\Error\LoaderError;
use Twig\Loader\FilesystemLoader;

class StackLoader extends FilesystemLoader
{
    /**
     * Default suffix to use
     *
     * Appends this suffix if the template requested does not use it.
     *
     * @var string
     */
    protected $suffix;

    /**
     * Set default file suffix
     *
     * @param string $suffix
     *
     * @return StackLoader
     */
    public function setSuffix($suffix)
    {
        $this->suffix = (string)$suffix;
        $this->suffix = ltrim($this->suffix, '.');

        return $this;
    }

    /**
     * Get default file suffix
     *
     * @return string
     */
    public function getSuffix()
    {
        return $this->suffix;
    }

    /**
     * @{@inheritdoc}
     */
    protected function findTemplate($name, $throw = true)
    {

        $name = $this->normalizeName((string)$name);

        // Ensure we have the expected file extension
        $defaultSuffix = $this->getSuffix();
        if (pathinfo($name, PATHINFO_EXTENSION) != $defaultSuffix) {
            $name .= '.' . $defaultSuffix;
        }
        
        if (isset($this->cache[$name])) {
            return $this->cache[$name];
        }
        
        $this->validateName($name);

        
        list($namespace, $name) = $this->parseName($name);

        if (!isset($this->paths[$namespace])) {
            if ($throw) {
                throw new LoaderError(sprintf('There are no registered paths for namespace "%s".', $namespace));
            }

            return false;
        }
        
        foreach ($this->paths[$namespace] as $path) {
            if (is_file($path . '/' . $name)) {
                return $this->cache[$name] = $path . '/' . $name;
            }
        }

        if ($throw) {
            throw new LoaderError(sprintf(
                'Unable to find template "%s" (looked into: %s).',
                $name,
                implode(', ', $this->paths[$namespace])
            ));
        }





        return parent::findTemplate($name, $throw);
    }

    
    private function normalizeName(string $name): string
    {
        return preg_replace('#/{2,}#', '/', str_replace('\\', '/', $name));
    }

    private function parseName(string $name, string $default = self::MAIN_NAMESPACE): array
    {
        if (isset($name[0]) && '@' == $name[0]) {
            if (false === $pos = strpos($name, '/')) {
                throw new LoaderError(sprintf('Malformed namespaced template name "%s" (expecting "@namespace/template_name").', $name));
            }

            $namespace = substr($name, 1, $pos - 1);
            $shortname = substr($name, $pos + 1);

            return [$namespace, $shortname];
        }

        return [$default, $name];
    }

    private function validateName(string $name): void
    {
        if (str_contains($name, "\0")) {
            throw new LoaderError('A template name cannot contain NUL bytes.');
        }

        $name = ltrim($name, '/');
        $parts = explode('/', $name);
        $level = 0;
        foreach ($parts as $part) {
            if ('..' === $part) {
                --$level;
            } elseif ('.' !== $part) {
                ++$level;
            }

            if ($level < 0) {
                throw new LoaderError(sprintf('Looks like you try to load a template outside configured directories (%s).', $name));
            }
        }
    }

    private function isAbsolutePath(string $file): bool
    {
        return strspn($file, '/\\', 0, 1)
            || (\strlen($file) > 3 && ctype_alpha($file[0])
                && ':' === $file[1]
                && strspn($file, '/\\', 2, 1)
            )
            || null !== parse_url($file, \PHP_URL_SCHEME)
        ;
    }
}

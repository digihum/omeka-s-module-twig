# Extensions
Define Your new extensions for twig this ``` service_manager ``` configuration:
```php
    'service_manager' => [
        'factories' => [
            \OmekaTwig\Test\Fixture\Extension\InstanceOfExtension::class => \OmekaTwig\Service\TwigExtensionFactory::class,
        ],
    ],
    'omeka_twig'       => [
        'extensions' => [
            \OmekaTwig\Test\Fixture\Extension\InstanceOfExtension::class,
        ],
    ],
```

Extension class example:

```php
    class NewExtension extends \OmekaTwig\Extension\AbstractExtension
    {
        /**
         * Common code for Twig Extensions
         */
    }
```

After that Your extension will be loaded as Twig extensions.

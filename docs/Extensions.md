# Extensions
Define Your new extensions for twig this ``` service_manager ``` configuration:
```php
    'service_manager' => [
        'factories' => [
            \ThemeTwig\Test\Fixture\Extension\InstanceOfExtension::class => \ThemeTwig\Service\TwigExtensionFactory::class,
        ],
    ],
    'omeka_twig'       => [
        'extensions' => [
            \ThemeTwig\Test\Fixture\Extension\InstanceOfExtension::class,
        ],
    ],
```

Extension class example:

```php
    class NewExtension extends \ThemeTwig\Extension\AbstractExtension
    {
        /**
         * Common code for Twig Extensions
         */
    }
```

After that Your extension will be loaded as Twig extensions.

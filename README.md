# Twig module for Omeka-S

This module integrates the [Twig](https://github.com/twigphp/Twig) template engine with [Omeka-S](https://github.com/omeka-s/omeka-s).

## Thanks
This project borrows heavily from [ZendTwig](https://github.com/OxCom/zf3-twig) by OxCom.

## Installation

1. Copy the project files into `$OMEKA_ROOT/modules/OmekaTwig`
2. If you installed via `git clone` (or the `vendor` directory does not exist for some other reason) run `composer install`
3. Go into the Omeka-S admin UI and activate the module

## Using Twig templates in themes

The module makes Omeka-S look for `*.twig` files in the normal theme directories. If a `*.twig` file is not found it then falls back to looking for a `*.phtml` file. E.g. if `layout.phtml` and `layout.twig` are both in `/view/layout` and the module is enabled `layout.twig` will be rendered. If the module is then disabled `layout.phtml` will be rendered.

If a twig template contains a phtml sub-template the subtemplate will be rendered using the normal Omeka-S phtml renderer. However, phtml templates **cannot** contain twig sub-templates.

An example `layout.twig` based on the default theme is available in `/docs/examples`.


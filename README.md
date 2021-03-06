# Twig Navigation Extension

[![Author](https://img.shields.io/badge/author-@m2mtech-blue.svg?style=flat-square)](http://www.m2m.at)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)

---

This bundle provides Twig extensions for common navigation widgets as well as their stimulus controllers wired for [symfony UX](https://symfony.com/doc/current/frontend/ux.html).

## Installation

```bash
composer require m2mtech/ux-navigation
```

If you are not using Flex enable the bundle:

```php
// config/bundles.php

return [
    // ...
    M2MTech\UxNavigation\M2MTechUxNavigationBundle::class => ['all' => true],
];
```

If you want to use the bundled stimulus controllers install the Javascript dependencies and compile them:

```bash
yarn install --force
yarn encore dev
```


## Usage

| Function                                            | Description                                              |
|-----------------------------------------------------|----------------------------------------------------------|
| [`m2mDarkModeSelector()`](docs/darkModeSelector.md) | Renders dark mode selector.                              |
| [`m2mLanguageSelector()`](docs/languageSelector.md) | Renders links from the current path to switch languages. |

Documentation can be found in the [./docs](docs/index.md) directory.


## Testing

This package has been developed for php 7.4 with compatibility tested for php 7.2 to 8.1.

```bash
composer test

# or the Javascript respectively  
cd src/Resources/assets; yarn test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information about recent changes.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

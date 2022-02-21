# `m2mLanguageSelector()`

Renders links from the current path to switch languages.

## Usage

```twig
{{ m2mLanguageSelector() }}
```

will result in

```html
<div class="languageSelector">
    <a href="/en/languageSelector">english</a>
    |
    <a href="/fr/languageSelector">francais</a>
    |
    <a href="/de/languageSelector">deutsch</a>
</div>
```

The shown languages can be adjusted via the configuration:

```yaml
m2m_ux_navigation:
    language_selection:
        languages: [de, en]
```

The layout can be adjusted using css

```sass
.languageSelector {
    ...
        
    a { ... }
}
```

over by overriding `@M2MTechUxNavigation/language_selector.html.twig`.

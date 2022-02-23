# `m2mLanguageSelector()`

Renders dark a mode selector in form of a button which is connected to a stimulus controller. Clicking the button will add or remove a class "dark" to the html document and store the result in the local storage of the browser as well as change the icon of the button. Please note - CSS code to display the actual dark mode of your site is not included in this package.

## Usage

```twig
{{ m2mDarkModeSelector() }}
```

will result in a font awsome-styled button:

```html
<button>
    <i aria-hidden="true" class="far fa-lightbulb-on fa-fw"></i>
</button>
```

The icons/classes of the button can be adjusted via the configuration:

```yaml
// config.yaml
m2mtech_ux_navigation:
    dark_mode:
        classes: [fa-lightbulb-on, fa-lightbulb] // classes of the <i> tag
        attributes: [lightbulb-on, lightbulb] // data-atrributes of the rendered svg icon
```

The layout can be adjusted using css over by overriding `@M2MTechUxNavigation/dark_mode_selector.html.twig`.

To set the current mode (class) on page load please add the following twig function inside your page header before other scripts are laoded:

```twig
<head>
    ... 
    {{ m2mDarkModeHeader() }}
    <script ...>
</head>
```

This will add a tiny bit of javascript which checks the local storage of the browser for previously chosen modes or the `prefers-color-scheme` of the browser.

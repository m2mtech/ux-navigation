# UPGRADE FROM 1.x to 2.0

## Bundle name

```diff
// config/bundles.php

return [
    // ...
-    M2MTech\TwigNavigationExtension\M2MTechTwigNavigationExtensionBundle::class => ['all' => true],
+    M2MTech\UxNavigation\M2MTechUxNavigationBundle::class => ['all' => true],
];
```

```diff
// config/*/config.yaml

- m2mtech_twig_navigation_extension:
+ m2mtech_ux_navigation:
    language_selection:
```

## Twig funcitons
```diff
// templates/*.html.twig

- {{ languageSelector() }}
+ {{ m2mLanguageSelector() }}
```


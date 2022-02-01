<?php
/*
 * This file is part of the twig-navigation-extension package.
 *
 * (c) 2022 m2m server software gmbh <tech@m2m.at>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace M2MTech\TwigNavigationExtension\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class NavigationExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        $options = [
            'needs_environment' => true,
            'needs_context' => true,
            'is_safe' => ['html'],
        ];

        return [
            new TwigFunction('languageSelector', [LanguageSelector::class, 'twigFunction'], $options),
        ];
    }
}

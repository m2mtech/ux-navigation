<?php
/*
 * This file is part of the ux-navigation package.
 *
 * (c) 2022 m2m server software gmbh <tech@m2m.at>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace M2MTech\UxNavigation\Twig;

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
            new TwigFunction('m2mDarkModeHeader', [DarkModeSelector::class, 'twigFunctionHeader'], $options),
            new TwigFunction('m2mDarkModeSelector', [DarkModeSelector::class, 'twigFunctionSelector'], $options),
            new TwigFunction('m2mLanguageSelector', [LanguageSelector::class, 'twigFunction'], $options),
        ];
    }
}

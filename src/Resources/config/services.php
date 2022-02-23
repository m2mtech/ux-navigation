<?php
/*
 * This file is part of the ux-navigation package.
 *
 * (c) 2022 m2m server software gmbh <tech@m2m.at>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use M2MTech\UxNavigation\Twig\DarkModeSelector;
use M2MTech\UxNavigation\Twig\LanguageSelector;
use M2MTech\UxNavigation\Twig\NavigationExtension;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use function Symfony\Component\DependencyInjection\Loader\Configurator\abstract_arg;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services
        ->set('m2mtech.ux.navigation.twig.extension.navigation', NavigationExtension::class)
        ->tag('twig.extension')

        ->set('m2mtech.ux.navigation.twig.runtime.language.selector', LanguageSelector::class)
        ->args([
            abstract_arg('languages'),
        ])
        ->tag('twig.runtime')

        ->set('m2mtech.ux.navigation.twig.runtime.dark.mode.selector', DarkModeSelector::class)
        ->args([
            abstract_arg('config'),
        ])
        ->tag('twig.runtime')
    ;
};

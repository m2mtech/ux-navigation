<?php
/*
 * This file is part of the ux-navigation package.
 *
 * (c) 2022 m2m server software gmbh <tech@m2m.at>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace M2MTech\UxNavigation\DependencyInjection;

use M2MTech\UxNavigation\Twig\DarkModeSelector;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('m2mtech_ux_navigation');

        $treeBuilder->getRootNode()
            ->children()
                ->arrayNode('dark_mode')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('classes')
                            ->scalarPrototype()->end()
                            ->defaultValue([DarkModeSelector::CLASS_LIGHT, DarkModeSelector::CLASS_DARK])
                        ->end()
                        ->arrayNode('attributes')
                            ->scalarPrototype()->end()
                            ->defaultValue([DarkModeSelector::ATTRIBUTE_LIGHT, DarkModeSelector::ATTRIBUTE_DARK])
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('language_selection')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('languages')
                            ->scalarPrototype()->end()
                            ->defaultValue(['en', 'de', 'fr'])
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}

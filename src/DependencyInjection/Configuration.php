<?php
/*
 * This file is part of the twig-navigation-extension package.
 *
 * (c) 2022 m2m server software gmbh <tech@m2m.at>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace M2MTech\TwigNavigationExtension\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('m2m_twig_navigation_extension');

        $treeBuilder->getRootNode()
            ->children()
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

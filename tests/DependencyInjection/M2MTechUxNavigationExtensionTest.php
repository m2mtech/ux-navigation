<?php
/*
 * This file is part of the ux-navigation package.
 *
 * (c) 2022 m2m server software gmbh <tech@m2m.at>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace M2MTech\UxNavigation\Tests\DependencyInjection;

use Exception;
use M2MTech\UxNavigation\DependencyInjection\M2MTechUxNavigationExtension;
use M2MTech\UxNavigation\Twig\DarkModeSelector;
use M2MTech\UxNavigation\Twig\LanguageSelector;
use M2MTech\UxNavigation\Twig\NavigationExtension;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class M2MTechUxNavigationExtensionTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testLoad(): void
    {
        $extension = new M2MTechUxNavigationExtension();
        $container = new ContainerBuilder();
        $extension->load([], $container);

        $definition = $container->getDefinition('m2mtech.ux.navigation.twig.extension.navigation');
        $this->assertTrue($definition->hasTag('twig.extension'));
        $twigExtension = $container->get('m2mtech.ux.navigation.twig.extension.navigation');
        $this->assertInstanceOf(NavigationExtension::class, $twigExtension);

        $definition = $container->getDefinition('m2mtech.ux.navigation.twig.runtime.language.selector');
        $this->assertTrue($definition->hasTag('twig.runtime'));
        $twigRuntime = $container->get('m2mtech.ux.navigation.twig.runtime.language.selector');
        $this->assertInstanceOf(LanguageSelector::class, $twigRuntime);

        $definition = $container->getDefinition('m2mtech.ux.navigation.twig.runtime.dark.mode.selector');
        $this->assertTrue($definition->hasTag('twig.runtime'));
        $twigRuntime = $container->get('m2mtech.ux.navigation.twig.runtime.dark.mode.selector');
        $this->assertInstanceOf(DarkModeSelector::class, $twigRuntime);
    }

    public function testGetAlias(): void
    {
        $extension = new M2MTechUxNavigationExtension();
        $this->assertSame('m2mtech_ux_navigation', $extension->getAlias());
    }
}

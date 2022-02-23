<?php
/*
 * This file is part of the ux-navigation package.
 *
 * (c) 2022 m2m server software gmbh <tech@m2m.at>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use M2MTech\UxNavigation\DependencyInjection\M2MTechUxNavigationExtension;
use M2MTech\UxNavigation\M2MTechUxNavigationBundle;
use PHPUnit\Framework\TestCase;

class M2MTechUxNavigationBundleTest extends TestCase
{
    public function testGetContainerExtension(): void
    {
        $bundle = new M2MTechUxNavigationBundle();
        $extension = $bundle->getContainerExtension();

        $this->assertInstanceOf(M2MTechUxNavigationExtension::class, $extension);
    }
}

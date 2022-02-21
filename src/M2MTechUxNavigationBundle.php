<?php
/*
 * This file is part of the ux-navigation package.
 *
 * (c) 2022 m2m server software gmbh <tech@m2m.at>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace M2MTech\UxNavigation;

use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class M2MTechUxNavigationBundle extends Bundle
{
    public function getContainerExtension(): ?ExtensionInterface
    {
        $this->extension = $this->createContainerExtension();

        return parent::getContainerExtension();
    }
}

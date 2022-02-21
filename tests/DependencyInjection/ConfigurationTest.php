<?php
/*
 * This file is part of the ux-navigation package.
 *
 * (c) 2022 m2m server software gmbh <tech@m2m.at>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace M2MTech\UxNavigation\Tests\DependencyInjection;

use M2MTech\UxNavigation\DependencyInjection\Configuration;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Config\Definition\Processor;

class ConfigurationTest extends TestCase
{
    public function testDefault(): void
    {
        $this->assertEquals([
            'language_selection' => [
                'languages' => ['en', 'de', 'fr'],
            ],
        ], $this->getConfig([]));
    }

    public function testLanguages(): void
    {
        $config = [
            'language_selection' => [
                'languages' => ['de', 'en'],
            ],
        ];
        $this->assertEquals($config, $this->getConfig($config));
    }

    /**
     * @param array<string,array<string,string[]>> $input
     *
     * @return array<string,array<string,string[]>>
     */
    private function getConfig(array $input): array
    {
        return (new Processor())->processConfiguration(new Configuration(), [$input]);
    }
}

<?php
/*
 * This file is part of the ux-navigation package.
 *
 * (c) 2022 m2m server software gmbh <tech@m2m.at>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace M2MTech\UxNavigation\Tests\Twig;

use M2MTech\UxNavigation\Twig\DarkModeSelector;
use PHPUnit\Framework\TestCase;
use Twig\Environment;
use Twig\Error\Error;

class DarkModeSelectorTest extends TestCase
{
    /**
     * @dataProvider configProvider
     *
     * @param array{classes: string[], attributes: string[]} $config
     * @param array{controller: string, values: array{}} $expectedParameters
     *
     * @throws Error
     */
    public function testTwigFunction(array $config, array $expectedParameters): void
    {
        $darkModeSelector = new DarkModeSelector($config);
        $twig = $this->createMock(Environment::class);
        $twig->expects($this->once())
            ->method('render')
            ->with(
                '@M2MTechUxNavigation/dark_mode_selector.html.twig',
                $expectedParameters
            )
            ->willReturn('ok')
        ;

        $darkModeSelector->twigFunctionSelector($twig);
    }

    public function configProvider(): iterable
    {
        yield [[
            'classes' => ['fa-lightbulb', 'fa-lightbulb-on'],
            'attributes' => ['lightbulb', 'lightbulb-on'],
        ], [
            'controller' => '@m2mtech/ux-navigation/dark-mode',
            'values' => [],
        ]];

        yield [[
            'classes' => ['other', 'fa-lightbulb-on'],
            'attributes' => ['lightbulb', 'lightbulb-on'],
        ], [
            'controller' => '@m2mtech/ux-navigation/dark-mode',
            'values' => [
                'classes' => ['other', 'fa-lightbulb-on'],
            ],
        ]];

        yield [[
            'classes' => ['fa-lightbulb', 'fa-lightbulb-on'],
            'attributes' => ['lightbulb', 'other'],
        ], [
            'controller' => '@m2mtech/ux-navigation/dark-mode',
            'values' => [
                'attributes' => ['lightbulb', 'other'],
            ],
        ]];

        yield [[
            'classes' => ['a', 'b'],
            'attributes' => ['c', 'd'],
        ], [
            'controller' => '@m2mtech/ux-navigation/dark-mode',
            'values' => [
                'classes' => ['a', 'b'],
                'attributes' => ['c', 'd'],
            ],
        ]];
    }
}

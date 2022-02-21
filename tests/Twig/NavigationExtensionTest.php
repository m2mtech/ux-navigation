<?php
/*
 * This file is part of the ux-navigation package.
 *
 * (c) 2022 m2m server software gmbh <tech@m2m.at>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace M2MTech\UxNavigation\Tests\Twig;

use M2MTech\UxNavigation\Twig\LanguageSelector;
use M2MTech\UxNavigation\Twig\NavigationExtension;
use Symfony\Bridge\Twig\AppVariable;
use Symfony\Component\HttpFoundation\InputBag;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;
use Twig\RuntimeLoader\FactoryRuntimeLoader;
use Twig\Test\IntegrationTestCase;

class NavigationExtensionTest extends IntegrationTestCase
{
    protected function getFixturesDir(): string
    {
        return __DIR__.'/fixtures';
    }

    protected function getExtensions()
    {
        return [
            new NavigationExtension(),
        ];
    }

    protected function getRuntimeLoaders()
    {
        return [
            new FactoryRuntimeLoader([
                LanguageSelector::class => function (): LanguageSelector {
                    return new LanguageSelector(['en', 'de']);
                },
            ]),
        ];
    }

    protected function getApp(): AppVariable
    {
        $request = $this->createMock(Request::class);
        $request->attributes = new ParameterBag([
            '_route' => 'https://localhost/',
            '_route_params' => [],
        ]);
        $request->query = new InputBag([]);
        $app = $this->createMock(AppVariable::class);
        $app->method('getRequest')
            ->willReturn($request);

        return $app;
    }
}

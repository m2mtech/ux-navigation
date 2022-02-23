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
use PHPUnit\Framework\TestCase;
use Symfony\Bridge\Twig\AppVariable;
use Symfony\Component\HttpFoundation\Request;
use Twig\Environment;
use Twig\Error\Error;

class LanguageSelectorTest extends TestCase
{
    /**
     * @throws Error
     */
    public function testTwigFunction(): void
    {
        $languageSelector = new LanguageSelector(['en', 'de']);
        $twig = $this->createMock(Environment::class);
        $twig->method('render')
            ->willReturnArgument(0);
        $app = $this->createMock(AppVariable::class);

        $this->assertSame(
            '@M2MTechUxNavigation/language_selector.html.twig',
            $languageSelector->twigFunction($twig, ['app' => $app])
        );
    }

    public function testGetLanguagePaths(): void
    {
        $languageSelector = new LanguageSelector(['en', 'de']);

        $request = new Request([
            'q' => 'query',
        ], [], [
            '_route' => 'theRoute',
            '_route_params' => [
                'parameter' => 1,
            ],
        ]);
        $app = $this->createMock(AppVariable::class);
        $app->method('getRequest')
            ->willReturn($request);
        $this->assertSame([
            [
                'locale' => 'en',
                'name' => 'English',
                'route' => 'theRoute',
                'parameters' => [
                    '_locale' => 'en',
                    'parameter' => 1,
                    'q' => 'query',
                ],
            ],
            [
                'locale' => 'de',
                'name' => 'Deutsch',
                'route' => 'theRoute',
                'parameters' => [
                    '_locale' => 'de',
                    'parameter' => 1,
                    'q' => 'query',
                ],
            ],
        ], $languageSelector->getLanguagePaths($app));
    }
}

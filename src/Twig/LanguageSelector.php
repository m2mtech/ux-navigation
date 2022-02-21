<?php
/*
 * This file is part of the ux-navigation package.
 *
 * (c) 2022 m2m server software gmbh <tech@m2m.at>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace M2MTech\UxNavigation\Twig;

use Symfony\Bridge\Twig\AppVariable;
use Symfony\Component\Intl\Languages;
use Twig\Environment;
use Twig\Error\Error;
use Twig\Extension\RuntimeExtensionInterface;

class LanguageSelector implements RuntimeExtensionInterface
{
    /** @var string[] */
    private $languages;

    /**
     * @param string[] $languages
     */
    public function __construct(array $languages)
    {
        $this->languages = $languages;
    }

    /**
     * @param array{app: AppVariable} $context
     *
     * @throws Error
     */
    public function twigFunction(Environment $env, array $context): string
    {
        $languagePaths = $this->getLanguagePaths($context['app']);

        return $env->render('@M2MTechUxNavigation/language_selector.html.twig', [
            'paths' => $languagePaths,
        ]);
    }

    /**
     * @return array<array{locale: string, name: string, route: string, parameters: array<string,string>}>
     */
    public function getLanguagePaths(AppVariable $app): array
    {
        $request = $app->getRequest();
        $route = '';
        if ($request) {
            /** @var string $route */
            $route = $request->attributes->get('_route') ?? '';
        }

        $params = [];
        if ($request) {
            /** @var array<string,string> $params */
            $params = $request->attributes->get('_route_params');
            $params += $request->query->all();
        }

        return array_map(static function (string $language) use ($route, $params) {
            return [
                'locale' => $language,
                'name' => Languages::getName($language, $language),
                'route' => $route,
                'parameters' => ['_locale' => $language] + $params,
            ];
        }, $this->languages);
    }
}

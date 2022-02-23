<?php
/*
 * This file is part of the ux-navigation package.
 *
 * (c) 2022 m2m server software gmbh <tech@m2m.at>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace M2MTech\UxNavigation\Twig;

use Twig\Environment;
use Twig\Error\Error;
use Twig\Extension\RuntimeExtensionInterface;

class DarkModeSelector implements RuntimeExtensionInterface
{
    public const CLASS_LIGHT = 'fa-lightbulb';
    public const CLASS_DARK = 'fa-lightbulb-on';
    public const CLASSES = [self::CLASS_LIGHT, self::CLASS_DARK];
    public const ATTRIBUTE_LIGHT = 'lightbulb';
    public const ATTRIBUTE_DARK = 'lightbulb-on';
    public const ATTRIBUTES = [self::ATTRIBUTE_LIGHT, self::ATTRIBUTE_DARK];

    /** @var string[][] */
    private $config;

    /**
     * @param string[][] $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * @throws Error
     */
    public function twigFunctionHeader(Environment $env): string
    {
        return $env->render('@M2MTechUxNavigation/dark_mode_header.html.twig');
    }

    /**
     * @throws Error
     */
    public function twigFunctionSelector(Environment $env): string
    {
        $values = [];
        if (self::CLASSES !== $this->config['classes']) {
            $values['classes'] = $this->config['classes'];
        }
        if (self::ATTRIBUTES !== $this->config['attributes']) {
            $values['attributes'] = $this->config['attributes'];
        }

        return $env->render('@M2MTechUxNavigation/dark_mode_selector.html.twig', [
            'controller' => '@m2mtech/ux-navigation/dark-mode',
            'values' => $values,
        ]);
    }
}

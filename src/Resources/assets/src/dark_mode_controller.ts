/*
 * This file is part of the ux-navigation package.
 *
 * (c) 2022 m2m server software gmbh <tech@m2m.at>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

'use strict';

import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static values = {
        classes: { type: Array, default: ['fa-lightbulb', 'fa-lightbulb-on'] },
        attributes: { type: Array, default: ['lightbulb', 'lightbulb-on'] },
    };
    classesValue: any;
    attributesValue: any;

    connect() {
        this.setDarkMode(
            window.localStorage.theme !== 'dark' &&
                ('theme' in localStorage || !window.matchMedia('(prefers-color-scheme: dark)').matches)
        );
    }

    toggle() {
        this.setDarkMode(window.localStorage.theme === 'dark');
    }

    setDarkMode($isLight: boolean) {
        const fa = this.element.querySelector('i');
        const svg = this.element.querySelector('svg');

        if ($isLight) {
            document.documentElement.classList.remove('dark');
            window.localStorage.setItem('theme', 'light');

            if (svg) {
                svg.setAttribute('data-icon', this.attributesValue[0]);
            }

            if (fa) {
                fa.classList.remove(this.classesValue[1]);
                fa.classList.add(this.classesValue[0]);
            }
        } else {
            document.documentElement.classList.add('dark');
            window.localStorage.setItem('theme', 'dark');

            if (svg) {
                svg.setAttribute('data-icon', this.attributesValue[1]);
            }

            if (fa) {
                fa.classList.remove(this.classesValue[0]);
                fa.classList.add(this.classesValue[1]);
            }
        }
    }
}

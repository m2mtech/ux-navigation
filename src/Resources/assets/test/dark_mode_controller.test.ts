/*
 * This file is part of the ux-navigation package.
 *
 * (c) 2022 m2m server software gmbh <tech@m2m.at>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

'use strict';

import { Application } from '@hotwired/stimulus';
import { getByTestId, waitFor } from '@testing-library/dom';
import { clearDOM, mountDOM } from '@symfony/stimulus-testing';
import DarkModeController from '../src/dark_mode_controller';

let application;

const startStimulus = () => {
    application = Application.start();
    application.register('dark-mode', DarkModeController);
};

window.matchMedia = jest.fn();

const setMatchMedia = (isDark: boolean) => {
    (window.matchMedia as jest.Mock).mockImplementation(() => {
        return { matches: isDark };
    });
};

describe('DarkModeController', () => {
    let container;

    beforeEach(() => {
        container = mountDOM(`
            <button data-testid="container" type="button" class="darkModeSelector" aria-expanded="false" aria-label="toggle.dark.mode" data-controller="dark-mode" data-action="dark-mode#toggle">
                <i data-testid="fontAwesome" aria-hidden="true" class="far fa-lightbulb fa-fw"></i>
                <svg data-testid="svg" data-icon="lightbulb"></svg>
            </button>
        `);
    });

    afterEach(() => {
        application.stop();
        clearDOM();
        container = '';
        localStorage.clear();
    });

    async function expectTheme(theme: string, isDark: boolean, hasClass: string, hasNotClass: string, icon: string) {
        await waitFor(() => expect(localStorage.getItem('theme')).toBe(theme));
        if (isDark) {
            expect(document.documentElement).toHaveClass('dark');
        } else {
            expect(document.documentElement).not.toHaveClass('dark');
        }
        expect(getByTestId(container, 'fontAwesome')).toHaveClass(hasClass);
        expect(getByTestId(container, 'fontAwesome')).not.toHaveClass(hasNotClass);
        expect(getByTestId(container, 'svg')).toHaveAttribute('data-icon', icon);
    }

    it('media light', async () => {
        setMatchMedia(false);
        startStimulus();
        await expectTheme('light', false, 'fa-lightbulb', 'fa-lightbulb-on', 'lightbulb');
    });

    it('media dark', async () => {
        setMatchMedia(true);
        startStimulus();

        await expectTheme('dark', true, 'fa-lightbulb-on', 'fa-lightbulb', 'lightbulb-on');
    });

    it('storage light', async () => {
        localStorage.theme = 'light';
        startStimulus();

        await expectTheme('light', false, 'fa-lightbulb', 'fa-lightbulb-on', 'lightbulb');
    });

    it('storage dark', async () => {
        localStorage.theme = 'dark';
        startStimulus();

        await expectTheme('dark', true, 'fa-lightbulb-on', 'fa-lightbulb', 'lightbulb-on');
    });

    it('toggle', async () => {
        localStorage.theme = 'light';
        startStimulus();

        await expectTheme('light', false, 'fa-lightbulb', 'fa-lightbulb-on', 'lightbulb');

        getByTestId(container, 'container').click();
        await expectTheme('dark', true, 'fa-lightbulb-on', 'fa-lightbulb', 'lightbulb-on');

        getByTestId(container, 'container').click();
        await expectTheme('light', false, 'fa-lightbulb', 'fa-lightbulb-on', 'lightbulb');
    });

    it('custom classes & attributes', async () => {
        container = mountDOM(`
            <button data-testid="container" type="button" class="darkModeSelector" aria-expanded="false" aria-label="toggle.dark.mode"
                data-controller="dark-mode" data-action="dark-mode#toggle"
                data-dark-mode-classes-value="[&quot;a&quot;,&quot;b&quot;]"
                data-dark-mode-attributes-value="[&quot;c&quot;,&quot;d&quot;]">
                <i data-testid="fontAwesome" aria-hidden="true" class="far fa-lightbulb fa-fw"></i>
                <svg data-testid="svg" data-icon="lightbulb"></svg>
            </button>
        `);

        localStorage.theme = 'light';

        startStimulus();

        await expectTheme('light', false, 'a', 'b', 'c');

        getByTestId(container, 'container').click();
        await expectTheme('dark', true, 'b', 'a', 'd');

        getByTestId(container, 'container').click();
        await expectTheme('light', false, 'a', 'b', 'c');
    });
});

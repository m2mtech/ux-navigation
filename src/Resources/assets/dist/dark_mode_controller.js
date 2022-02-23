import { Controller } from '@hotwired/stimulus';

class default_1 extends Controller {
    connect() {
        this.setDarkMode(window.localStorage.theme !== 'dark' &&
            ('theme' in localStorage || !window.matchMedia('(prefers-color-scheme: dark)').matches));
    }
    toggle() {
        this.setDarkMode(window.localStorage.theme === 'dark');
    }
    setDarkMode($isLight) {
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
        }
        else {
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
default_1.values = {
    classes: { type: Array, default: ['fa-lightbulb', 'fa-lightbulb-on'] },
    attributes: { type: Array, default: ['lightbulb', 'lightbulb-on'] },
};

export { default_1 as default };

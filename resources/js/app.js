require('./bootstrap');
const blinder = require('color-blind');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

window.addEventListener('update-colors', event => {
    const backgroundColor = event.detail[0];
    const textColor = event.detail[1];
    const colors = {
        original: {
            backgroundColor: backgroundColor,
            textColor: textColor
        },
        protanomaly: {
            backgroundColor: blinder.protanomaly(backgroundColor),
            textColor: blinder.protanomaly(textColor)
        },
        protanopia: {
            backgroundColor: blinder.protanopia(backgroundColor),
            textColor: blinder.protanopia(textColor)
        },
        deuteranomaly: {
            backgroundColor: blinder.deuteranomaly(backgroundColor),
            textColor: blinder.deuteranomaly(textColor)
        },
        deuteranopia: {
            backgroundColor: blinder.deuteranopia(backgroundColor),
            textColor: blinder.deuteranopia(textColor)
        },
        tritanomaly: {
            backgroundColor: blinder.tritanomaly(backgroundColor),
            textColor: blinder.tritanomaly(textColor)
        },
        tritanopia: {
            backgroundColor: blinder.tritanopia(backgroundColor),
            textColor: blinder.tritanopia(textColor)
        },
        achromatomaly: {
            backgroundColor: blinder.achromatomaly(backgroundColor),
            textColor: blinder.achromatomaly(textColor)
        },
        achromatopsia: {
            backgroundColor: blinder.achromatopsia(backgroundColor),
            textColor: blinder.achromatopsia(textColor)
        }
    }
    window.localStorage.setItem('colors', JSON.stringify(colors));
})

import Pikaday from 'pikaday';
import util from './utils';

export default class AppPlugins {

    constructor() {
        this.$pikADayField = $('[data-plugin="pikaday"]');

        this.initPikADay();
    }

    initPikADay() {
        this.$pikADayField.each((index, element) => new Pikaday(util.pikADayOption(element)));
    }
}
import Datepicker from "flowbite-datepicker/Datepicker";
import { locales } from "../../node_modules/flowbite-datepicker/js/i18n/base-locales.js";
import ja from "../../node_modules/flowbite-datepicker/js/i18n/locales/ja.js";

Datepicker.locales.ja = ja.ja;

const datepickerOptions = {
    locales: "ja",
    language: "ja",
    format: "yyyymmdd",
    weekStart: 1,
};

document.querySelectorAll("[datepicker]").forEach(function (datepickerEl) {
    const dp = new Datepicker(datepickerEl, datepickerOptions);
});

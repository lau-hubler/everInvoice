import numeral from "numeral";
import moment from "moment";

const percentageFormatter = function (value) {
    if (!value) {
        value = 0;
    }

    return numeral(value).format("0.0[0]%");
};

const moneyFormatter = function (value) {
    if (!value) {
        return "$ 0.00";
    }

    return numeral(value).format("($ 0,0.00)");
};

const dateTimeFormatter = function (value, lang) {
    moment.locale("en");
    if (value) {
        return moment(String(value)).format("LLL");
    }
};

const dateFormatter = function (value, lang) {
    moment.locale("en");
    if (value) {
        return moment(String(value)).format("L");
    }
};

export { percentageFormatter, moneyFormatter, dateTimeFormatter, dateFormatter };

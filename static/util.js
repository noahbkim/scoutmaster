function twoDigit(string) {
    return ("00" + string).substr(-2);
}

function formatDigitalTime(date) {
    return twoDigit(date.getHours()) + ":" + twoDigit(date.getMinutes()) + ":" + twoDigit(date.getSeconds());
}
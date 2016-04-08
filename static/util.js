function twoDigit(string) {
    return ("00" + string).substr(-2);
}

function formatDigitalTime(date, seconds) {
    var out = twoDigit(date.getHours()) + ":" + twoDigit(date.getMinutes());
    if (seconds === true) out += ":" + twoDigit(date.getSeconds());
    return out;
}

function formatDifferenceTime(date1, date2) {
    minutes = Math.abs(date2 - date1) / (60*1000);
    hours = Math.floor(minutes / 60);
    minutes = Math.floor(minutes % 60);
    return hours + ":" + twoDigit(minutes);
}

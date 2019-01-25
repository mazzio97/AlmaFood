function getDateFromUTC(utc) {
    var date = new Date();
    date.setTime(utc * 1000);
    return date.toLocaleString().replace(",", "");
}
function getUTCFromDate(date) {
    return Math.floor(date.getTime() / 1000);
}
function getHoursMin(utc) {
    return getDateFromUTC(utc).getHours() + ":" + getDateFromUTC(utc).getMinutes();
}

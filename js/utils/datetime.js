function getDateFromUTC(utc) {
    var date = new Date();
    date.setTime(utc * 1000);
    return date.toLocaleString("it-IT", {
      year: "2-digit",
      month: "2-digit",
      day: "2-digit",
      hour: "2-digit",
      minute: "2-digit"
    }).replace(",", "");
}
function getUTCFromDate(date) {
    return Math.floor(date.getTime() / 1000);
}
function getHoursMin(utc) {
    return getDateFromUTC(utc).substr(9, 5);
}

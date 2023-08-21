$(document).ready(function () {
    autoTimeSelect();
});
function autoTimeSelect() {
    var now = new Date();
    var year = now.getFullYear();
    var month = now.getMonth() + 1;
    var day = now.getDate();
    var hour = now.getHours();
    var localDatetime =
        year +
        "-" +
        (month < 10 ? "0" + month.toString() : month) +
        "-" +
        (day < 10 ? "0" + day.toString() : day) +
        "T" +
        (hour < 10 ? "0" + hour.toString() : hour) +
        ":" +
        "00" +
        ":" +
        "00";
    $("#start_date_time").val(localDatetime);
    $("#end_date_time").val(localDatetime);
}

$(document).ready(function () {
    showPurpose();
});

function showPurpose() {
    $(".showPurpose").click(function () {
        var id = $(this).attr("id");
        $(".tr-" + id).toggleClass("d-none");
        $(this).find(".fa-caret-down").parent().toggleClass("d-none");
        $(this).find(".fa-caret-up").parent().toggleClass("d-none");
        $("#setDeviceId").val(id);
    });
}

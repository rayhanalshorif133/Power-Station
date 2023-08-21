$(document).ready(function () {
    note();
    seeMore();
    lessMore();
});

function note() {
    $(".note").each(function () {
        var note = $(this).text();
        if (note.length > 350) {
            $(this).text(note.substring(0, 350) + "...");
            $(this).next().next().removeClass("d-none");
        }
    });
}

function seeMore() {
    $(".seeMore").click(function () {
        let note = $(this).parent().find(".note");
        let moreNote = $(this).parent().find(".moreNote");
        note.addClass("d-none");
        moreNote.removeClass("d-none");

        // toggle
        $(this).toggleClass("d-none");
        $(this).next().toggleClass("d-none");
    });
}
function lessMore() {
    $(".lessMore").click(function () {
        let note = $(this).parent().find(".note");
        let moreNote = $(this).parent().find(".moreNote");
        note.removeClass("d-none");
        moreNote.addClass("d-none");

        // toggle
        $(this).toggleClass("d-none");
        $(this).prev().toggleClass("d-none");
    });
}

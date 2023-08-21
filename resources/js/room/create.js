$(document).ready(function () {
    handleCreateBtn();
    addShelf();
    handleSubmitBtn();
    deleteShelfBtn();
});

function handleCreateBtn() {
    $(".createBtn").on("click", function () {
        var roomName = $('input[name="name"]').val();
        var rack = $('input[name="rack"]').val();
        var shelf = $('input[name="shelf"]').val();

        if (rack == "" || roomName == "") {
            toastr.error("Please fill all the required fields");
            return false;
        }

        $(".resetBtn").removeClass("d-none");
        $(".createBtn").addClass("d-none");
        $(".submitBtn").removeAttr("disabled");
        var html = "";
        for (let index = 0; index < rack; index++) {
            html += `<h6 class="fs-0 mb-1"><span class="fas fa-server text-info me-1"
                        data-fa-transform="shrink-2"></span>Rack-${
                            index + 1
                        }</h6><hr>
                        <div class="appendShelf row" id="rackNumber-${
                            index + 1
                        }"></div>
                        `;
        }
        $(".appendRackAndShelf").append(html);
        html = "";
        for (let index = 0; index < shelf; index++) {
            html += `<div class="col-lg-2 col-md-3 col-sm-4 shelf" data-index="${
                index + 1
            }">
                                <div class="border border-300 rounded-2 p-2 mb-4 text-center bg-white dark__bg-1000 shadow-sm cursor-pointer">
                                    <span class="d-flex justify-content-end deleteShelfBtn">
                                        <span class="fas fa-trash m-0 p-0 text-danger"></span>
                                    </span>
                                    <span class="text-900 fs-3 fas fa-boxes mt-1"></span>
                                    <p class=" mt-3 text-center w-100 text-dark border-300">
                                        Shelf ${index + 1}
                                    </p>
                                </div>
                            </div>`;
        }
        $(".appendShelf").append(html);
        $(".appendShelf").append(`
                <div class="col-lg-2 col-md-3 col-sm-4 addShelf shelf">
                    <div class="border border-300 rounded-2 py-3 mb-4 text-center bg-white dark__bg-1000 shadow-sm cursor-pointer">
                        <span class="text-900 fs-3 fas fa-plus mt-1" style="margin-top: 13px!important;margin-bottom: -8px;"></span>
                        <p class="mt-3 text-center w-100 text-dark border-300">
                            Add Shelf
                        </p>
                    </div>
                </div>
                `);
    });
    $(".resetBtn").on("click", function () {
        $('input[name="name"]').val("");
        $('input[name="rack"]').val("");
        $('input[name="shelf"]').val("");
        $(".appendRackAndShelf").html("");
        $(".resetBtn").addClass("d-none");
        $(".createBtn").removeClass("d-none");
        $(".submitBtn").attr("disabled", "disabled");
    });
}

function addShelf() {
    $(document).on("click", ".addShelf", function () {
        var beforeElement = $(this).prev();
        var index = beforeElement.data("index");
        if (index == undefined) {
            index = 0;
        }
        $(this).before(`
                <div class="col-lg-2 col-md-3 col-sm-4 shelf" data-index="${
                    index + 1
                }">
                    <div class="border border-300 rounded-2 p-2 mb-4 text-center bg-white dark__bg-1000 shadow-sm cursor-pointer">
                        <span class="d-flex justify-content-end deleteShelfBtn">
                            <span class="fas fa-trash m-0 p-0 text-danger"></span>
                        </span>
                        <span class="text-900 fs-3 fas fa-boxes mt-1"></span>
                        <p class=" mt-3 text-center w-100 text-dark border-300">
                            Shelf ${index + 1}
                        </p>
                    </div>
                </div>
                `);
        resetIndexAndShelfNumber();
    });
}

function handleSubmitBtn() {
    $(document).on("click", ".submitBtn", function () {
        var roomName = $('input[name="name"]').val();
        var rack = $('input[name="rack"]').val();
        var shelf = $('input[name="shelf"]').val();
        var description = $('textarea[name="description"]').val();

        var rack_details = [];
        for (let index = 0; index < rack; index++) {
            var shelf_number = $(`#rackNumber-${index + 1}`)
                .children()
                .last()
                .prev()
                .data("index");
            rack_details.push({
                rack: index + 1,
                shelf: shelf_number,
            });
        }
        var data = {
            name: roomName,
            rack: rack,
            rack_details: rack_details,
            description: description,
        };
        axios
            .post("/room/store", data)
            .then(function (response) {
                let data = response.data;
                if (data.status == true) {
                    toastr.success(data.message);
                    setTimeout(function () {
                        window.location.href = "/room";
                    }, 1000);
                } else {
                    toastr.error(data.message);
                }
            })
            .catch(function (error) {
                console.log(error);
            });
    });
}

function deleteShelfBtn() {
    $(document).on("click", ".deleteShelfBtn", function () {
        $(this).parent().parent().remove();
        let index = $(this).parent().parent().data("index");
        resetIndexAndShelfNumber();
        toastr.success("Shelf " + index + " deleted successfully");
    });
}

function resetIndexAndShelfNumber() {
    var setIndex = 1;
    $(".appendShelf .shelf").each(function (index) {
        if ($(this).hasClass("addShelf")) {
            return false;
        }
        $(this).attr("data-index", setIndex);
        $(this).find("p").text(`Shelf ${setIndex}`);
        setIndex++;
    });
}

var id = "";
var tr = "";
var name = "";
$(document).ready(function () {
    editBtn();
    checkBtn();
    deleteBtn();
    deleteSelectedItems();
});

function editBtn() {
    $(".editBtn").on("click", function () {
        tr = $(this).closest("tr");
        id = tr.attr("id");
        // toggle edit and check button
        $(this).toggleClass("d-none");
        $(this).siblings(".checkBtn").toggleClass("d-none");

        // toggle input and text
        name = tr.find(".statusName").text();
        tr.find(".statusName").html(
            '<input type="text" class="form-control" value="' + name + '">'
        );
    });
}
function checkBtn() {
    $(".checkBtn").on("click", function () {
        tr = $(this).closest("tr");
        id = tr.attr("id");
        // toggle edit and check button
        $(this).toggleClass("d-none");
        $(this).siblings(".editBtn").toggleClass("d-none");

        // toggle input and text
        name = tr.find(".statusName input").val();
        let data = {
            id: id,
            name: name,
        };
        axios.post("/device/status/update", data).then(function (response) {
            let data = response.data;
            if (data.status == true) {
                toastr.success(data.message);
                tr.find(".statusName").html(data.data.name);
                tr.find(".statusAddedBy").html(data.data.added_by.name);
            } else {
                toastr.error(data.message);
            }
        });
    });
}

function deleteBtn() {
    $(".deleteBtn").on("click", function () {
        tr = $(this).closest("tr");
        id = tr.attr("id");

        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this data!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                swal("Done! Your data has been deleted", {
                    icon: "success",
                });

                axios
                    .delete(`/device/status/${id}/delete`)
                    .then(function (response) {
                        let data = response.data;
                        if (data.status == true) {
                            toastr.success(data.message);
                            tr.remove();
                        } else {
                            toastr.error(data.message);
                        }
                    });
            } else {
                swal("Your data is now deleted", {
                    icon: "error",
                });
            }
        });
    });
}

function deleteSelectedItems() {
    $(".deviceStatusApplyBtn").click(function () {
        let selected = $(".deviceStatusActionSelect").val();
        if (selected == "delete") {
            let selectedIds = [];
            $(".deviceStatusCheckbox:checked").each(function () {
                selectedIds.push($(this).closest("tr").attr("id"));
            });
            if (selectedIds.length > 0) {
                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this data!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        swal("Done! Your data has been deleted", {
                            icon: "success",
                        });
                        axios
                            .post("/device/status/delete-selected", {
                                ids: selectedIds,
                            })
                            .then(function (response) {
                                location.reload();
                            });
                    } else {
                        swal("Your data is now deleted", {
                            icon: "error",
                        });
                    }
                });
            } else {
                toastr.warning("Please select at least one item");
            }
        }
    });
}

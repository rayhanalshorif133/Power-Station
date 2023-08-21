var tr = "";
var id = "";
var name = "";
var thisClick = "";
$(document).ready(function () {
    editBtn();
    checkBtn();
    deleteBtn();
    multipleDeleteBtn();
});

function editBtn() {
    $(".editBtn").click(function () {
        tr = $(this).closest("tr");
        id = tr.attr("id");
        name = tr.find("td:eq(1)").text();
        tr.find("td:eq(1)").html(
            '<input type="text" class="form-control" value="' + name + '">'
        );
        $(this).addClass("d-none");
        tr.find(".checkBtn").removeClass("d-none");
    });
}

function checkBtn() {
    $(".checkBtn").click(function () {
        tr = $(this).closest("tr");
        id = tr.attr("id");
        thisClick = $(this);
        name = tr.find("td:eq(1) input").val();
        let data = {
            id: id,
            name: name,
        };

        // send back end and update data
        axios.post("/device/area/update", data).then(function (response) {
            let { status, data } = response.data;
            if (status == true) {
                tr.find("td:eq(1)").html(data.name);
                tr.find("td:eq(2)").html(data.added_by.name);
                thisClick.addClass("d-none");
                tr.find(".editBtn").removeClass("d-none");
                toastr.success("Area updated successfully");
            } else {
                toastr.error("Area name is already exist");
            }
        });
    });
}

function deleteBtn() {
    $(".deleteBtn").click(function () {
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
                // send back end and update data
                axios
                    .delete(`/device/area/${id}/delete`)
                    .then(function (response) {
                        let { status } = response.data;
                        if (status == true) {
                            tr.remove();
                            toastr.success("Area deleted successfully");
                        } else {
                            toastr.error("Something went wrong");
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

function multipleDeleteBtn() {
    $(".areaApplyBtn").click(function () {
        var areaActionSelect = $(".areaActionSelect").val();
        if (areaActionSelect == "delete") {
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

                    let ids = [];
                    $(".areaCheckInput").each(function () {
                        if ($(this).is(":checked")) {
                            ids.push($(this).closest("tr").attr("id"));
                        }
                    });
                    // send back end and update data
                    axios
                        .post(`/device/area/delete-selected`, { ids: ids })
                        .then(function (response) {
                            let { status } = response.data;
                            if (status == true) {
                                toastr.success("Area deleted successfully");
                                location.reload();
                            } else {
                                toastr.error("Something went wrong");
                            }
                        });
                } else {
                    swal("Your data is now deleted", {
                        icon: "error",
                    });
                }
            });
        } else {
            toastr.warning("Please select action");
        }
    });
}

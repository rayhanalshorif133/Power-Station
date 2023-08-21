var id = "";
var tr = "";
var name = "";
var addedBy = "";
var thisClick = "";
$(document).ready(function () {
    editBtn();
    checkBtn();
    deleteBtn();
    multipleSelectedAndDelete();
});

function multipleSelectedAndDelete() {
    $(".sectionApplyBtn").click(function () {
        var selected = [];
        $(".sectionCheckInput:checked").each(function () {
            selected.push($(this).closest("tr").attr("id"));
        });
        var action = $(".sectionActionSelect").val();
        if (action == "delete") {
            deleteDeviceSection(selected);
        } else {
            toastr.warning("Please select action");
        }
    });
}

function deleteDeviceSection(selected) {
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
                .post(`/device/section/delete-selected`, {
                    ids: selected,
                })
                .then(function (response) {
                    let data = response.data;
                    if (data.status == true) {
                        toastr.success(data.message);
                        location.reload();
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
}
function editBtn() {
    $(".editDeviceSectionBtn").click(function () {
        tr = $(this).closest("tr");
        id = tr.attr("id");
        $(this).addClass("d-none");
        $(this).siblings(".checkDeviceSectionBtn").removeClass("d-none");
        name = tr.find(".sectionName").text();
        tr.find(".sectionName").html(
            '<input type="text" class="form-control" value="' + name + '">'
        );
    });
}
function checkBtn() {
    $(".checkDeviceSectionBtn").click(function () {
        tr = $(this).closest("tr");
        id = tr.attr("id");
        thisClick = $(this);

        name = tr.find(".sectionName input").val();
        let data = {
            id: id,
            name: name,
        };

        axios
            .post("/device/section/update", data)
            .then(function (response) {
                let { data, status } = response.data;
                if (status == true) {
                    tr.find(".sectionName").html(data.name);
                    tr.find(".sectionAddedBy").html(data.added_by.name);
                    thisClick.addClass("d-none");
                    thisClick
                        .siblings(".editDeviceSectionBtn")
                        .removeClass("d-none");
                    toastr.success("Section Updated Successfully");
                } else {
                    toastr.error("Name field is required or already exists");
                }
            })
            .catch(function (error) {
                console.log(error);
            });
    });
}

function deleteBtn() {
    $(".deleteDeviceSectionBtn").click(function () {
        tr = $(this).closest("tr");
        id = tr.attr("id");
        console.log(id);
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
                    .delete(`/device/section/${id}/delete`)
                    .then(function (response) {
                        let { data, status } = response.data;
                        if (status == true) {
                            tr.remove();
                            toastr.success("Section Deleted Successfully");
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

var id = "";
var tr = "";
var deviceName = "";
var newDeviceName = "";
$(document).ready(function () {
    editBtn();
    checkBtn();
    deleteBtn();
    deleteSelectedItems();
});

function deleteSelectedItems() {
    $(".mainDeviceApplyBtn").click(function () {
        console.log("mainDeviceApplyBtn");
        let selected = $(".mainDeviceActionSelect").val();
        console.log(selected);
        if (selected == "delete") {
            let selectedIds = [];
            $(".mainDeviceCheckbox:checked").each(function () {
                selectedIds.push($(this).closest("tr").attr("id"));
            });
            console.log(selectedIds);
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
                            .post("/device/main-device/delete-selected", {
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

function deleteBtn() {
    $(".deleteMainDeviceBtn").click(function () {
        id = $(this).closest("tr").attr("id");
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
                    .delete(`/device/main-device/${id}/delete`)
                    .then(function (response) {
                        location.reload();
                    });
            } else {
                swal("Your data is now deleted", {
                    icon: "error",
                });
            }
        });
    });
}
function editBtn() {
    $(".editMainDeviceBtn").click(function () {
        tr = $(this).closest("tr");
        id = tr.attr("id");
        toggleBtn(tr);
        deviceName = tr.find(".mainDeviceName").text();
        tr.find(".mainDeviceName").html(
            '<input type="text" class="form-control" value="' +
                deviceName +
                '">'
        );
    });
}
function checkBtn() {
    $(".checkMainDeviceBtn").click(function () {
        tr = $(this).closest("tr");
        id = tr.attr("id");
        newDeviceName = tr.find(".mainDeviceName input").val();
        if (newDeviceName) {
            sendBackedAndUpdatedData();
        } else {
            toastr.warning("Please enter a valid name");
        }
    });
}

function sendBackedAndUpdatedData() {
    let data = {
        id: id,
        name: newDeviceName,
    };
    axios.post("/device/main-device/update", data).then(function (response) {
        let { status, error, data } = response.data;
        if (status == true) {
            tr.find(".mainDeviceName").html(newDeviceName);
            tr.find(".mainDeviceAddedBy").text(data.added_by.name);
            toastr.success("Main Device Updated Successfully");
            toggleBtn(tr);
        } else {
            toastr.error("Main Device name is invalid or not unique");
        }
    });
}

function toggleBtn(tr) {
    tr.find(".editMainDeviceBtn").toggleClass("d-none");
    tr.find(".checkMainDeviceBtn").toggleClass("d-none");
}

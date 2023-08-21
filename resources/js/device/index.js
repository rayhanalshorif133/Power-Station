var id = "";
var tr = "";
var selectedDevice = "";
var selectedAction = "";
var deviceIDs = [];
var table = "";

$(document).ready(function () {
    deviceDeleteBtn();
    multiSelectDevice();
    handleSelectedDevice();
});

function handleSelectedDevice() {
    table = $("#deviceListTableId").DataTable();
    $(document).on("change", ".checkAll", function () {
        deviceIDs = [];
        table
            .rows()
            .data()
            .each(function (value, index) {
                if ($(".checkAll").is(":checked")) {
                    deviceIDs.push(
                        $(value[0])
                            .find("input")
                            .attr("data-device-selected-id")
                    );
                } else {
                    deviceIDs = [];
                }
            });
    });
    $(document).on("change", ".selectedDevice", function () {
        var thisDeviceID = $(this).attr("data-device-selected-id");
        if ($(this).is(":checked")) {
            deviceIDs.push(thisDeviceID);
        } else {
            deviceIDs.map(function (value, index, arr) {
                if (thisDeviceID == value) {
                    var index = deviceIDs.indexOf(value);
                    deviceIDs.splice(index, 1);
                }
            });
        }
    });
}

function deviceDeleteBtn() {
    $(document).on("click", ".deviceDeleteBtn", function () {
        id = $(this).attr("id").split("-")[1];
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
                axios.delete(`/device/${id}/delete`).then(function (response) {
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

function multiSelectDevice() {
    $(document).on("click", ".deviceApplyBtn", function () {
        selectedAction = $(".deviceActionSelect").val();
        if (selectedAction == null) {
            swal("Please select an action", {
                icon: "error",
            });
        } else if (selectedAction == "delete") {
            selectedDeviceDelete();
        } else {
            let data = {
                ids: deviceIDs,
                status_id: selectedAction,
            };
            axios.post("device/update-status", data).then(function (response) {
                location.reload();
            });
        }
    });
}

function selectedDeviceDelete() {
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
                .post("/device/multi-selected-device/delete", {
                    ids: deviceIDs,
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
}

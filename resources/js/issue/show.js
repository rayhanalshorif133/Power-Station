const { default: axios } = require("axios");

var id = 0;
var tr = "";
var collaborationSelectDepartment = "";
$(document).ready(function () {
    editBtnIssueHasDevice();
    checkBtnIssueHasDevice();
    showDeviceStatus();
    handleDepartmentByTomSelect();
    // Collaboration & Forwarded Part
    forwardedSelectDepartmentHandler();
    fromForwardedSelectDepartmentHandler();
    collaborationSelectDepartmentHandler();
});

function forwardedSelectDepartmentHandler() {
    $(".issueForwardBtn").click(function () {
        id = $("#issueID").val();
        axios
            .get(`/issue/${id}/fetch-not-issue-Department`)
            .then(function (response) {
                let departments = response.data.data;
                $("#forwardedDepartmentSelectedId").empty();
                if (departments.length > 0) {
                    $("#forwardedDepartmentSelectedId").append(
                        `<option value="" disabled selected>Select Department</option>`
                    );
                    departments.forEach(function (department) {
                        $("#forwardedDepartmentSelectedId").append(
                            `<option value="${department.id}">${department.name}</option>`
                        );
                    });
                }
            });
    });
}
function fromForwardedSelectDepartmentHandler() {
    $(".issueForwardBtn").click(function () {
        id = $("#issueID").val();
        axios
            .get(`/issue/${id}/fetch-issue-Department`)
            .then(function (response) {
                let departments = response.data.data;
                $("#fromForwardedDepartmentSelectedId").empty();
                if (departments.length > 0) {
                    $("#fromForwardedDepartmentSelectedId").append(
                        `<option value="" disabled selected>Select Department</option>`
                    );
                    departments.forEach(function (department) {
                        $("#fromForwardedDepartmentSelectedId").append(
                            `<option value="${department.id}">${department.name}</option>`
                        );
                    });
                }
            });
    });
}

function collaborationSelectDepartmentHandler() {
    $(".issueCollaborationBtn").click(function () {
        id = $("#issueID").val();
        axios
            .get(`/issue/${id}/fetch-not-issue-Department`)
            .then(function (response) {
                let departments = response.data.data;
                let appendOptions = [];
                if (departments.length > 0) {
                    departments.forEach(function (department) {
                        let pushValue = {
                            value: department.id,
                            text: department.name,
                        };
                        appendOptions.push(pushValue);
                    });
                }
                collaborationSelectDepartment.addOption(appendOptions);
            });
    });
}

function handleDepartmentByTomSelect() {
    collaborationSelectDepartment = new TomSelect("#departmentIDSelect", {
        create: false,
        sortField: {
            field: "text",
            direction: "asc",
        },
    });
}

function editBtnIssueHasDevice() {
    $(".editBtnIssueHasDevice").on("click", function (e) {
        id = $(this).parent().attr("id");
        tr = $(this).parent().parent();
        // toggle btn
        $(this).addClass("d-none");
        $(this).parent().find(".checkBtnIssueHasDevice").removeClass("d-none");
        // toggle input
        tr.find(".deviceName span:nth(0)").addClass("d-none");
        tr.find(".deviceName span:nth(1)").removeClass("d-none");
        tr.find(".status span:nth(0)").addClass("d-none");
        tr.find(".status span:nth(1)").removeClass("d-none");

        // set selected status
        var status = tr.find(".status span:nth(0)").text();
        tr.find(".status select option").each(function () {
            if ($(this).text().toLowerCase() == status.toLowerCase()) {
                $(this).prop("selected", true);
            }
        });
    });
}
function checkBtnIssueHasDevice() {
    $(".checkBtnIssueHasDevice").on("click", function (e) {
        // toggle btn
        $(this).addClass("d-none");
        $(this).parent().find(".editBtnIssueHasDevice").removeClass("d-none");
        tr = $(this).parent().parent();
        // toggle input
        tr.find(".deviceName span:nth(0)").removeClass("d-none");
        tr.find(".deviceName span:nth(1)").addClass("d-none");
        tr.find(".status span:nth(0)").removeClass("d-none");
        tr.find(".status span:nth(1)").addClass("d-none");

        let editDevice_id = tr.find(".deviceName span select").val();
        let editStatus = tr.find(".status span select").val();

        let data = {
            id: id,
            editDeviceId: editDevice_id,
            editStatus: editStatus,
        };

        axios.post("/issue/edit-device", data).then(function (response) {
            if (response.data.status == true) {
                let { devices, needed_status } = response.data.data;
                tr.find(".deviceName span:nth(0)").text(devices.name);
                tr.find(".status span:nth(0)").text(needed_status.name);
                toastr.success(response.data.message);
            } else {
                toastr.error(response.data.message);
            }
        });
    });
}

function showDeviceStatus() {
    $("#addedNewDeviceIdOption").on("change", function () {
        let device_id = $(this).val();
        axios
            .get(`/device/${device_id}/fetch-device-by-id`)
            .then(function (response) {
                let device = response.data.data.device_status;
                // handleSelectedDeviceOption(device);
                $(".showDeviceStatusDiv").removeClass("d-none");
                if (response.data.data.device_status) {
                    $(".showDeviceStatus").text(device.name);
                    // removeClass
                    $(".showDeviceStatus").removeClass("badge-soft-success");
                    $(".showDeviceStatus").removeClass("badge-soft-danger");
                    $(".showDeviceStatus").removeClass("badge-soft-warning");
                    if (device.name == "Open") {
                        $(".showDeviceStatus").addClass("badge-soft-success");
                    } else if (device.name == "Close") {
                        $(".showDeviceStatus").addClass("badge-soft-danger");
                    } else {
                        $(".showDeviceStatus").addClass("badge-soft-warning");
                    }
                } else {
                    $(".showDeviceStatus").text("Not Found");
                }
            });
    });
}

// function handleSelectedDeviceOption(device) {
//     console.log(device);
//     $("#needed_status")
//         .find("option")
//         .each(function () {
//             if ($(this).val() == device.id) {
//                 $(this).remove();
//             }
//         });
// }

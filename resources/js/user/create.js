var role_id = false;
var department_id = false;
$(document).ready(function () {
    userCreateSubmitBtnHandler();
    roleID();
    departmentID();
});

function roleID() {
    $("#role_id").on("change", function () {
        role_id = true;
        userCreateSubmitBtnHandler();
    });
}
function departmentID() {
    $("#department_id").on("change", function () {
        department_id = true;
        userCreateSubmitBtnHandler();
    });
}

function userCreateSubmitBtnHandler() {
    if (role_id && department_id) {
        $(".userCreateSubmitBtn").prop("disabled", false);
    } else {
        $(".userCreateSubmitBtn").prop("disabled", true);
    }
}

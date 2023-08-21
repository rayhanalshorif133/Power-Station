const { default: axios } = require("axios");

var userIdSelect = "";
var id = "";
$(document).ready(function () {
    editAndAssignUser();
    createAssignUsers();
    departmentDelete();
});

function departmentDelete() {
    $(".departmentDeleteBtn").click(function () {
        id = $(this).parent().parent().parent().attr("id");
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
                    .delete(`/department/${id}/delete`)
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

function createAssignUsers() {
    let getCreateAssignUsers = new TomSelect("#createAssignUsers", {
        create: false,
        sortField: {
            field: "text",
            direction: "asc",
        },
        plugins: {
            clear_button: {
                title: "Remove all selected options",
            },
        },
    });
    $(".ts-control").click(function () {
        id = $(".active").attr("data-value");
        getCreateAssignUsers.removeItem(id);
    });
}

function removeItemOneByOneClick() {
    $(".ts-control").click(function () {
        id = $(".active").attr("data-value");
        userIdSelect.removeItem(id);
    });
}

function editAndAssignUser() {
    $(".editAndAssignUser").click(function () {
        id = $(this).parent().parent().parent().attr("id");
        $("#setDepartmentId").val(id);
        assignUserTomSelectHandler();
        appendUserToSelect();
    });
}

function assignUserTomSelectHandler() {
    $(".appendSelectOfUserIds").html("");

    $(".appendSelectOfUserIds")
        .html(`<select id="userIdSelect" name="userIds[]" multiple autocomplete="off">
        <option value="">Select User</option>
        </select>`);

    userIdSelect = new TomSelect("#userIdSelect", {
        create: false,
        sortField: {
            field: "text",
            direction: "asc",
        },
        plugins: {
            clear_button: {
                title: "Remove all selected options",
            },
        },
    });
}

function appendUserToSelect() {
    axios.get("/user/fetch-users").then(function (response) {
        let users = response.data.data;
        userIdSelect.clear();
        users.forEach(function (user) {
            userIdSelect.addOption({
                value: user.id,
                text: user.name,
            });
        });
        setAlreadyAssignedUser();
    });
}

function setAlreadyAssignedUser() {
    axios.get(`/department/${id}/fetch-assign-user`).then(function (response) {
        let users = response.data.data;
        users.forEach(function (user) {
            userIdSelect.addItem(user.id);
        });
    });
    removeItemOneByOneClick();
}

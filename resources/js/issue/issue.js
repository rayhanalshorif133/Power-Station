var id = 0;
var tr = "";
var departmentIDs = "";
var departments = "";
var issueSelected = "";
$(document).ready(function () {
    radioBtnHandler();
    editBtnIssue();
    issueDeleteBtn();
    multiIssueDeleteBtn();
});
function radioBtnHandler() {
    $(".radioBtn").click(function () {
        $(".radioBtn").removeClass("active");
        $(this).addClass("active");
        $(this).parent().find('input[type="radio"]').prop("checked", true);
    });
}

function editBtnIssue() {
    $(document).on("click", ".editIssue", function () {
        id = $(this).attr("id").split("-")[1];

        // Set Value
        $("#issue_id").val(id);

        axios.get(`/issue/${id}/fetch`).then(function (response) {
            var issue = response.data.data;
            $("#edit_title").val(issue.title);
            $("#editDescription").val(issue.description);

            $(".radioBtn").each(function () {
                if (
                    $(this).parent().find('input[type="radio"]').val() ==
                    issue.seriousness
                ) {
                    $(this).addClass("active");
                    $(this)
                        .parent()
                        .find('input[type="radio"]')
                        .prop("checked", true);
                }
            });
            $("#editRecommendation").val(issue.recommendation);
            handleDepartmentByTomSelect(issue);
        });
    });
}

function handleDepartmentByTomSelect(issue) {
    $(".appendDepartmentSelect").html(`
            <select class="" name="department_id[]" id="edit_department_id" multiple>
            </select>
            `);
    departmentIDs = new TomSelect("#edit_department_id", {
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
    axios.get("/department/fetch-all").then(function (response) {
        departments = response.data.data;
        departments.forEach(function (department) {
            departmentIDs.addOption({
                value: department.id,
                text: department.name,
            });
        });
        issue.departments.forEach(function (department) {
            departmentIDs.addItem(department.id);
        });
    });

    departmentIDs.clear();
    issue.departments.forEach(function (department) {
        departmentIDs.addItem(department.id);
    });

    $(".ts-control").click(function () {
        id = $(".active").attr("data-value");
        userIdSelect.removeItem(id);
    });
}

function issueDeleteBtn() {
    $(document).on("click", ".issueDeleteBtn", function () {
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
                axios.delete(`/issue/${id}/delete`).then(function (response) {
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

function multiIssueDeleteBtn() {
    $(document).on("click", ".issueApplyBtn", function () {
        issueSelected = $(".issueActionSelect").val();
        if (issueSelected == "delete") {
            var issueIds = [];

            $(".checkedIssue").each(function () {
                if ($(this).is(":checked")) {
                    issueIds.push($(this).attr("data-issueId"));
                }
            });
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
                        .post(`/issue/multi-delete`, {
                            ids: issueIds,
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
            toastr.error("Please select action");
        }
    });
}

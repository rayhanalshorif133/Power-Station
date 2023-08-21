$(document).ready(function () {
    actions();
    changeStatus();
});

function changeStatus() {
    $(document).on("click", ".changeStatus", function () {
        var id = $(this).attr("class").split(" ")[0].split("-")[1];
        var status = $(this).text();
        var _this = $(this);
        let data = {
            id: id,
            status: status,
        };
        Swal.fire({
            title: "Are you sure?",
            text: "You want to change this user status!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, do it!",
        }).then((result) => {
            if (result.isConfirmed) {
                axios
                    .post("/user/status-update", data)
                    .then(function (response) {
                        let status = response.data.data.status;
                        if (status == "active") {
                            _this.removeClass("bg-danger");
                            _this.addClass("bg-primary");
                        } else {
                            _this.removeClass("bg-primary");
                            _this.addClass("bg-danger");
                        }
                        _this.text(response.data.data.status);
                        Swal.fire(
                            "Changed!",
                            "Status has been successfully changed.",
                            "success"
                        );
                    });
            } else {
                Swal.fire(
                    "Cancelled",
                    "User status has not been changed.",
                    "error"
                );
            }
        });
    });
}

function actions() {
    $(".userApplyBtn").click(function () {
        var ids = [];
        var action = $(".userActionSelect").val();
        $("input:checkbox:checked").each(function () {
            if (
                $(this).attr("data-bulk-select-row") == "data-bulk-select-row"
            ) {
                ids.push($(this).closest("tr").attr("id"));
            }
        });
        axios
            .post("/user/action-update", {
                ids: ids,
                action: action,
            })
            .then(function (response) {
                console.log(response.data.data);
            });
    });
}

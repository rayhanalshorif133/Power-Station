var id = "";
var tr = "";
var name = "";
var thisClick = "";
var select = "";

$(document).ready(function () {
    editBtn();
    checkBtn();
    deleteBtn();
    multiDelete();
});
function editBtn() {
    $(".editBtn").click(function () {
        tr = $(this).closest("tr");
        id = tr.attr("id");
        name = tr.find("td:eq(1)").text();
        // toggle edit and check button
        $(this).toggleClass("d-none");
        tr.find(".checkBtn").toggleClass("d-none");

        // toggle input and text
        tr.find("td:eq(1)").html(
            '<input type="text" class="form-control" value="' + name + '">'
        );
    });
}

function checkBtn() {
    $(".checkBtn").click(function () {
        tr = $(this).closest("tr");
        id = tr.attr("id");
        name = tr.find("td:eq(1) input").val();
        thisClick = $(this);

        // toggle input and text
        let data = { id: id, name: name };

        axios.post("/device/category/update", data).then(function (response) {
            let { data, message, status } = response.data;
            if (status == true) {
                // toggle edit and check button
                tr.find("td:eq(1)").html(data.name);
                tr.find("td:eq(2)").html(data.added_by.name);
                thisClick.toggleClass("d-none");
                tr.find(".editBtn").toggleClass("d-none");
                toastr.success(message);
            } else {
                toastr.error(message);
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
                axios
                    .delete(`/device/category/${id}/delete`)
                    .then(function (response) {
                        tr.remove();
                    });
            } else {
                swal("Your data is now deleted", {
                    icon: "error",
                });
            }
        });
    });
}

function multiDelete() {
    $(".categoryApplyBtn").click(function () {
        select = $(".categoryActionSelect").val();
        if (select == "delete") {
            let ids = [];
            $(".deviceCategoryInputCheck:checked").each(function () {
                ids.push($(this).closest("tr").attr("id"));
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
                        .post(`/device/category/delete-selected`, { ids: ids })
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

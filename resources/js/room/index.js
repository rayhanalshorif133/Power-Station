var id = 0;
var table = "";
$(document).ready(function () {
    table = $("#roomTableId").DataTable({ responsive: true });
    roomDeleteBtn();
});

function roomDeleteBtn() {
    $(document).on("click", ".roomDeleteBtn", function () {
        id = $(this).closest("div").attr("id").split("-")[1];
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this data!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                axios.delete(`/room/${id}/delete`).then(function (response) {
                    if (response.data.status == true) {
                        table
                            .row($(`#roomID-${id}`).closest("tr"))
                            .remove()
                            .draw();
                        toastr.success(response.data.message);
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

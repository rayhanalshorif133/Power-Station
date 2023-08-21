var table = "";
$(document).ready(function () {
    table = $(".shiftEngineerTable").DataTable({ responsive: true });
    handleViewAndEditIcon();
    shiftEngDeleteBtn();
});

function handleViewAndEditIcon() {
    setInterval(() => {
        if ($(".fa-pencil-alt").hasClass("d-none")) {
            $(".fa-pencil-alt").removeClass("d-none");
            $(".fa-eye").addClass("d-none");
        } else {
            $(".fa-pencil-alt").addClass("d-none");
            $(".fa-eye").removeClass("d-none");
        }
        if ($(".fa-pencil-alt").parent().hasClass("btn-falcon-primary")) {
            $(".fa-pencil-alt").parent().removeClass("btn-falcon-primary");
            $(".fa-pencil-alt").parent().addClass("btn-falcon-success");
        } else {
            $(".fa-pencil-alt").parent().removeClass("btn-falcon-success");
            $(".fa-pencil-alt").parent().addClass("btn-falcon-primary");
        }
    }, 3000);
}

function shiftEngDeleteBtn() {
    $(".shiftEngDeleteBtn").on("click", function () {
        var id = $(this).closest("tr").attr("id").split("-")[2];
        var thisClick = this;
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
                    .delete(`/shift-engineer/${id}/delete`)
                    .then(function (response) {
                        $(thisClick).closest("tr").remove();
                        table.row(`#shift-eng-${id}`).remove().draw();
                        toastr.success(response.data.message);
                    });
            } else {
                swal("Your data is now deleted", {
                    icon: "error",
                });
            }
        });
    });
}

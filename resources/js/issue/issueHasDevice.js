const { default: axios } = require("axios");

var id = 0;
$(document).ready(function () {
    deleteBtnIssueHasDevice();
});

function deleteBtnIssueHasDevice() {
    $(".deleteBtnIssueHasDevice").click(function () {
        id = $(this).parent().attr("id");

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
                    .delete(`/issue/${id}/delete-device`)
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

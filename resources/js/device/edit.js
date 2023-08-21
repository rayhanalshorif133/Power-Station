var id = "";
var imageKey = "";
$(document).ready(function () {
    deleteImage();
});
function deleteImage() {
    $(".deleteImage").click(function () {
        id = $(this).attr("id").split("-")[1];
        imageKey = $(this).parent().attr("id").split("-")[1];

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

                let data = {
                    id: id,
                    imageKey: imageKey,
                };
                axios
                    .post("/device/delete/image-one-by-one", data)
                    .then((response) => {
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

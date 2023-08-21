var selected = " ";
var table = "";
$(document).ready(function () {
    multiDeleteIssueLogs();
    handleTable();
});
function handleTable() {
    table = $("#issueHistoryLogId").DataTable();
}
function multiDeleteIssueLogs() {
    $(".issueLogsApplyBtn").on("click", function () {
        selected = $(".issueLogsActionSelect").val();
        if (selected == "delete") {
            var issueLogsIds = [];
            table.$('input[type="checkbox"]').each(function () {
                if (this.checked) {
                    issueLogsIds.push($(this).closest("tr").attr("id"));
                }
            });

            axios
                .post("/issue/logs/multiple/delete", {
                    issueLogsIds: issueLogsIds,
                })
                .then(function (response) {
                    location.reload();
                });
        }
    });
}

var assignUsers = "";
var table = "";
var users = "";
var monthAndYear = "";
var assignUsersText = [];
var sixAMToTwoPM = "";
var twoPMToTenPM = "";
var tenPMToSixAM = "";
$(document).ready(function () {
    handleDatepicker();
    assignUser();
    handleCreateBtn();
    table = $("#shiftEngineerCreateTableId").DataTable({
        responsive: true,
        paging: false,
        ordering: false,
    });
    handleSubmitBtn();
});
function handleDatepicker() {
    var dp = $("#datepicker").datepicker({
        format: "mm-yyyy",
        startView: "months",
        minViewMode: "months",
    });
    $(".datepicker").addClass("bg-1000");
}

function assignUser() {
    assignUsers = new TomSelect("#assignUser", {
        create: false,
        maxItems: 3,
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
    $("#assignUser").on("change", function () {
        if (assignUsers.getValue().length > 0) {
            $("#createBtn").attr("disabled", false);
        } else {
            $("#createBtn").attr("disabled", true);
        }
    });
}

function handleCreateBtn() {
    $("#createBtn").on("click", function () {
        var assignUser = assignUsers.getValue();

        if (!$("#datepicker").val()) {
            toastr.info("Please choose a month first...!!!");
            return false;
        }
        axios
            .post(`/shift-engineer/fetch/user-name`, {
                assignUsers: assignUser,
            })
            .then(function (response) {
                users = response.data.data;
                let html = "";
                for (let index = 0; index < users.length; index++) {
                    const element = users[index];
                    html += `<span id="${element.id}">${index + 1} . ${
                        element.name
                    } <br></span>`;
                }
                $(".assignUserAppend").text("");
                $(".assignUserAppend").append(html);
                if (users.length < 3) {
                    $(".noAssignUser").removeClass("d-none");
                } else {
                    $(".noAssignUser").addClass("d-none");
                }
            });
        handleMonthShiftTable();
    });
}

function handleMonthShiftTable() {
    monthAndYear = $("#datepicker").val();
    var month = monthAndYear.split("-")[0];
    var monthName = getMonthName(month);
    var year = monthAndYear.split("-")[1];
    var daysInMonth = new Date(year, month, 0).getDate();
    let assingUserLenght = assignUsers.getValue().length;
    table.clear().draw();
    for (let index = 0; index < daysInMonth; index++) {
        sixAMToTwoPM = getSixAMToTwoPM(index + 1, assingUserLenght);
        twoPMToTenPM = getTwoPMToTenPM(index + 1, assingUserLenght);
        tenPMToSixAM = getTenPMToSixAM(index + 1, assingUserLenght);
        table.row
            .add([
                `<span class="align-middle">${
                    index + 1
                }-${monthName}-${year}</span>`,
                `<span class="align-middle sixAMToTwoPM">${sixAMToTwoPM}</span>`,
                `<span class="align-middle twoPMToTenPM">${twoPMToTenPM}</span>`,
                `<span class="align-middle tenPMToSixAM">${tenPMToSixAM}</span>`,
                `<span class="align-middle" id="${index + 1}">
            <span class="btn btn-outline-info btn-sm editBtn">
              <span class="fas fa-edit"></span>
            </span>
            <span class="btn btn-outline-success btn-sm checkBtn d-none">
              <span class="fas fa-check"></span>
            </span>
            </span>`,
            ])
            .draw();
    }
    editBtn();
    checkBtn();
}

function editBtn() {
    $(document).on("click", ".editBtn", function () {
        $(this).addClass("d-none");
        $(this).next().removeClass("d-none");
        sixAMToTwoPM = $(this).closest("tr").find("td:eq(1)");
        twoPMToTenPM = $(this).closest("tr").find("td:eq(2)");
        tenPMToSixAM = $(this).closest("tr").find("td:eq(3)");
        sixAMToTwoPM.html(getDropdown(sixAMToTwoPM.text()));
        twoPMToTenPM.html(getDropdown(twoPMToTenPM.text()));
        tenPMToSixAM.html(getDropdown(tenPMToSixAM.text()));
    });
}

function getDropdown(text) {
    let length = assignUsers.getValue().length;
    let dropdown = `<select class="form-select" placeholder="Select one">`;
    if (length < 3) {
        if (text == 0) {
            dropdown += `<option value="0" selected>0</option>`;
        } else {
            dropdown += `<option value="0">0</option>`;
        }
    }
    let html = "";
    for (let index = 0; index < length; index++) {
        if (text == index + 1) {
            html += `<option value="${index + 1}" selected>${
                index + 1
            }</option>`;
        } else {
            html += `<option value="${index + 1}">${index + 1}</option>`;
        }
    }
    dropdown += html;
    dropdown += `</select>`;
    return dropdown;
}

function checkBtn() {
    $(document).on("click", ".checkBtn", function () {
        $(this).addClass("d-none");
        $(this).prev().removeClass("d-none");
        sixAMToTwoPM = $(this).closest("tr").find("td:eq(1)");
        twoPMToTenPM = $(this).closest("tr").find("td:eq(2)");
        tenPMToSixAM = $(this).closest("tr").find("td:eq(3)");
        sixAMToTwoPM.html(sixAMToTwoPM.find("select").val());
        twoPMToTenPM.html(twoPMToTenPM.find("select").val());
        tenPMToSixAM.html(tenPMToSixAM.find("select").val());
        toastr.success("Shift updated successfully...!!!");
    });
}

function getMonthName(month) {
    var monthNames = [
        "Jan",
        "Feb",
        "Mar",
        "Apr",
        "May",
        "Jun",
        "Jul",
        "Aug",
        "Sep",
        "Oct",
        "Nov",
        "Dec",
    ];
    return monthNames[month - 1];
}

function getSixAMToTwoPM(index, length) {
    if (index < 8) {
        return "1";
    } else if (index < 15) {
        if (length == 1 || length == 2) {
            return "0";
        } else {
            return "3";
        }
    } else if (index < 22) {
        if (length == 1) {
            return "0";
        } else {
            return "2";
        }
    } else if (index < 29) {
        return "1";
    } else {
        if (length == 1 || length == 2) {
            return "0";
        } else {
            return "3";
        }
    }
}

function getTwoPMToTenPM(index, length) {
    if (index < 8) {
        if (length == 1) {
            return "0";
        } else {
            return "2";
        }
    } else if (index < 15) {
        return "1";
    } else if (index < 22) {
        if (length == 1 || length == 2) {
            return "0";
        } else {
            return "3";
        }
    } else if (index < 29) {
        if (length == 1) {
            return "0";
        } else {
            return "2";
        }
    } else {
        return "1";
    }
}

function getTenPMToSixAM(index, length) {
    if (index < 8) {
        if (length == 1 || length == 2) {
            return "0";
        } else {
            return "3";
        }
    } else if (index < 15) {
        if (length == 1) {
            return "0";
        } else {
            return "2";
        }
    } else if (index < 22) {
        return "1";
    } else if (index < 29) {
        if (length == 1 || length == 2) {
            return "0";
        } else {
            return "3";
        }
    } else {
        if (length == 1) {
            return "0";
        } else {
            return "2";
        }
    }
}

function handleSubmitBtn() {
    $(document).on("click", ".submitBtn", function () {
        let data = [];
        let shiftName = $("#shiftName").val();
        if (!shiftName) {
            toastr.warning("Please enter a shift name...!!!");
            return false;
        }
        let length = assignUsers.getValue().length;
        if (length == 0) {
            toastr.warning("Please select atleast one user...!!!");
            return false;
        }

        assignUsersText = [];
        $(".assignUserAppend span").each(function () {
            let id = $(this).attr("id");
            let name = $(this).text();
            name = name.split(".");
            assignUsersText.push({ assign_user_ids: name[0], user_id: id });
        });

        $(".shiftEngineerCreateTableBody")
            .find("tr")
            .each(function () {
                let filterData = {};
                filterData["date"] = $(this).find("td:eq(0)").text();
                filterData["sixAMToTwoPM"] = getUserId(
                    $(this).find("td:eq(1)").text()
                );
                filterData["twoPMToTenPM"] = getUserId(
                    $(this).find("td:eq(2)").text()
                );
                filterData["tenPMToSixAM"] = getUserId(
                    $(this).find("td:eq(3)").text()
                );
                data.push(filterData);
            });

        // date format monthAndYear
        let date = monthAndYear.split("-");
        monthAndYear = date[1] + "-" + date[0];
        let shiftInfo = {
            shiftName: shiftName,
            yearMonth: monthAndYear,
            user_ids: assignUsers.getValue(),
            assignUsers: assignUsersText,
            shiftInfoDetails: data,
        };
        axios
            .post("/shift-engineer/store", shiftInfo)
            .then(function (response) {
                if (response.data.status == true) {
                    toastr.success(response.data.message);
                    setTimeout(function () {
                        window.location.href = "/shift-engineer/index";
                    }, 1000);
                } else {
                    toastr.error(response.data.message);
                }
            });
    });
}

function getUserId(text) {
    var returnId = -1;
    text = parseInt(text);
    if (text == 0) {
        returnId = 0;
    }
    $(".assignUserAppend span").each(function () {
        let name = $(this).text();
        let id = $(this).attr("id");
        name = name.split(".");
        if (parseInt(name[0]) == text) {
            returnId = id;
        }
    });
    return parseInt(returnId);
}

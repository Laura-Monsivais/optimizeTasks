import "./bootstrap";
import $ from "jquery";
$(document).ready(function () {
    $("th").click(function () {
        var columnIndex = $(this).index();
        $("tr").each(function () {
            var $cell = $(this).find("td").eq(columnIndex);
            $cell.toggleClass("selected");
        });
    });

    $(".select-all").click(function () {
        var columnIndex = $(this).closest("th").index();
        $("tr").each(function () {
            var $cell = $(this).find("td").eq(columnIndex);
            $cell.toggleClass("selected", $(this).prop("checked"));
        });
    });

    $(
        ".separate-last-name, .separate-address, .separate-full-name, .validate-curp, .create-person, .validate-gender"
    ).click(function () {
        var columnIndex = $("th input:checked").closest("th").index();
        var selectedColumns = $("th input:checked").length;

        if (selectedColumns !== 1) {
            showAlert('danger', 'Seleccione una columna.');
            return; 
        }
        var url = $(this).hasClass("separate-last-name")
            ? "/families/separateSurnames"
            : $(this).hasClass("separate-address")
            ? "/families/separateAddress"
            : $(this).hasClass("separate-full-name")
            ? "/students/separateFullName"
            : $(this).hasClass("validate-curp")
            ? "/families/validateCurp"
            : $(this).hasClass("create-person")
            ? "/students/create"
            : $(this).hasClass("validate-gender")
            ? "/persons/validateGender"
            : "";

            if (columnIndex >= 0) {
                sendData(url, columnIndex);
            } else {
                showAlert('danger','No se ha seleccionado ninguna columna.');
            }
    });

    function sendData(url, columnIndex) {
        var columnData = [];
        $("tr").each(function () {
            var $cell = $(this).find("td").eq(columnIndex);
            columnData.push($cell.text());
        });

        if (columnData.length > 0) {
            $.ajax({
                url: url,
                method: "POST",
                data: {
                    columnData: columnData,
                },
                success: function (response) {
                    if (url === "/families/separateSurnames") {
                        showAlert('success', response.message);
                    } else if (url === "/families/separateAddress") {
                        showAlert('success', response.message);
                    } else if (url === "/students/separateFullName") {
                        showAlert('success', response.message);
                    } else if (url === "/families/validateCurp") {
                    } else if (url === "/families/createPerson") {
                    } else if (url === "/families/validateGender") {
                    }
                },
                error: function (xhr, status, error) {
                    console.error(error);
                },
            });
        } else {
            alert("No hay datos en la columna seleccionada.");
        }
    }
});

function checkForUpdates() {
    $.ajax({
        url: "/check-updates",
        type: "GET",
        success: function (response) {
            if (response.changes) {
                location.reload();
            }
        },
        error: function (xhr, status, error) {
            console.error(error);
        },
    });
}

$(document).ready(function () {
    checkForUpdates();
    setInterval(checkForUpdates, 5000);
});


function showAlert(type, message) {
    $('.alert').remove();

    var alertClass = 'alert-' + type;
    var alertElement = $('<div class="alert ' + alertClass + '">' + message + '</div>');

    $('#alert-container').append(alertElement);

    setTimeout(function() {
        alertElement.fadeOut('slow', function() {
            $(this).remove();
        });
    }, 3000);
}
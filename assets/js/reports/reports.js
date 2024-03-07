// alert();

var load_dtr_summary = () => {
    $.ajax({
        type: 'POST',
        url: baseUrl + 'reports/load_dtr_summary',
        data: {
            selected_month: $('#select_month1').val(),
        },
        
        success: function (data) {
            $('#load_summary').html(data);
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}

var load_deduction_summary = () => {
    $.ajax({
        type: 'POST',
        url: baseUrl + 'reports/load_deduction_summary',
        data: {
            selected_month: $('#select_month2').val(),
        },
        
        success: function (data) {
            $('#deduction_summary').html(data);
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}

$(document).ready(function () {
    load_dtr_summary();
    load_deduction_summary();
});

$('#select_month1').change(function () {
    // alert($('#select_month').val());

    $.ajax({
        type: 'POST',
        url: baseUrl + 'reports/load_dtr_summary',
        data: {
            selected_month: $('#select_month1').val(),
        },
        
        success: function (data) {
            $('#load_summary').html(data);
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
});

$('#select_month2').change(function () {
    // alert($('#select_month').val());

    $.ajax({
        type: 'POST',
        url: baseUrl + 'reports/load_deduction_summary',
        data: {
            selected_month: $('#select_month2').val(),
        },
        
        success: function (data) {
            $('#deduction_summary').html(data);
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
});

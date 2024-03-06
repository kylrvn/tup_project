// alert();

var load_dtr_summary = () => {
    $.ajax({
        type: 'POST',
        url: baseUrl + 'reports/load_dtr_summary',
        data: {
            selected_month: $('#select_month').val(),
        },
        
        success: function (data) {
            $('#load_summary').html(data);
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}

$(document).ready(function () {
    load_dtr_summary();
});

$('#select_month').change(function () {
    // alert($('#select_month').val());

    $.ajax({
        type: 'POST',
        url: baseUrl + 'reports/load_dtr_summary',
        data: {
            selected_month: $('#select_month').val(),
        },
        
        success: function (data) {
            $('#load_summary').html(data);
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
});

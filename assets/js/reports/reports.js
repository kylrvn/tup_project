// alert();

function mirror_form() {
    var mirrorContent = document.getElementById('mirror').innerHTML;

    document.getElementById('load_mirror').innerHTML = mirrorContent;
}

var load_dtr_summary = () => {
    $.ajax({
        type: 'POST',
        url: baseUrl + 'reports/load_dtr_summary',
        data: {
            selected_month: $('#select_month1').val(),
            report_type: $('#report_type').val(),
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

var load_dtr = () => {
    $.ajax({
        type: 'POST',
        url: baseUrl + 'reports/load_dtr',
        data: {
            selected_faculty: $('#selected_faculty').val(),
            selected_month: $('#select_month3').val(),
        },

        success: function (data) {
            $('#dtr_form').html(data);
            mirror_form()
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}

$(document).ready(function () {
    load_dtr_summary();
    load_deduction_summary();
    load_dtr();
    mirror_form()
});

$('#select_month1').change(function () {
    // alert($('#select_month').val());

    $.ajax({
        type: 'POST',
        url: baseUrl + 'reports/load_dtr_summary',
        data: {
            selected_month: $('#select_month1').val(),
            report_type: $('#report_type').val(),
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

$('#report_type').change(function () {
    // alert($('#report_type').val());

    $.ajax({
        type: 'POST',
        url: baseUrl + 'reports/load_dtr_summary',
        data: {
            selected_month: $('#select_month1').val(),
            report_type: $('#report_type').val(),
        },

        success: function (data) {
            $('#load_summary').html(data);
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
});

$('#selected_faculty, #select_month3').change(function () {
    load_dtr();
});

$('#print_dtr_summary').click(function () {
    $('#load_summary').printThis({
        debug: false,
        importCSS: true,
        importStyle: true,
        copyTagClasses: true,
        removeScripts: false,
    });
});

$('#print_report_on_deduction').click(function () {
    $('#deduction_summary').printThis({
        debug: false,
        importCSS: true,
        importStyle: true,
        copyTagClasses: true,
        removeScripts: false,
    });
});


$('#print_csf_48').click(function () {
    $('#dtr_form').printThis({
        debug: false,
        importCSS: true,
        importStyle: true,
        copyTagClasses: true,
        removeScripts: false,
    });
});




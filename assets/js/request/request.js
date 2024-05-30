
//Date range picker
$('#request_filter_date').daterangepicker();
$('#dtr_filter_date').daterangepicker();

var load_attachements = () => {
    let currentDate = new Date();

    let month = currentDate.getMonth() + 1;
    let day = currentDate.getDate();
    let year = currentDate.getFullYear();

    let formattedDate = `${month < 10 ? '0' + month : month}/${day < 10 ? '0' + day : day}/${year}`;
    let comparisonDate = formattedDate + " - " + formattedDate;

    let dateToSend = null; // Data to POST

    if ($('#request_filter_date').val() == comparisonDate) {
        dateToSend = null;
    }
    else {
        dateToSend = $('#request_filter_date').val();
    }

    $.ajax({
        url: 'request/load_files',
        type: 'POST',
        data: {
            dateRange: dateToSend,
        },
        success: function (data) {
            // Update the content of the element with id 'load_file_table'
            $('#load_file_table').html(data);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error('Error loading attachments:', textStatus, errorThrown);
        }
    });
};

var load_dtr_request = () => {

    $.ajax({
        url: 'request/load_dtr_requests',
        type: 'POST',
        success: function (data) {
            // Update the content of the element with id 'load_dtr_verify'
            $('#load_dtr_verify').html(data);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error('Error loading DTR requests:', textStatus, errorThrown);
        }
    });
};


$(document).ready(function () {
    load_attachements();
    load_dtr_request();
});

function view_file(element) {
    // alert(element.getAttribute('data-id'));
    let ID = element.getAttribute('data-id');
    $.post({
        url: baseUrl + 'request/view_file',
        data: {
            ID: ID,
        },
        success: function (response) {
            $('#view_modal').modal('show');
            $('#modal_content').html(response);
        }
    })
}

let selected_ID = null;
function verify_file(element) {
    // alert(element.getAttribute('data-id'));
    // let ID = element.getAttribute('data-id');
    selected_ID = element.getAttribute('data-id');
    $('#view_req_verif_modal').modal('show');
    // $.post({
    //     url: baseUrl + 'request/verify_file',
    //     data: {
    //         ID: ID,
    //     },
    //     success: function (response) {
    //         toastr.success('Request Verified Successfuly');
    //         load_attachements();
    //     }
    // })
}

$(document).on('click', '#approve_leave', function () {
    // alert(selected_ID);
    // return;
    $.post({
        url: baseUrl + 'request/service/request_service/save_leave_date',
        data: {
            facultyID: selected_ID,
            leaveType: $('#leave_type').val(),
            leaveDate: $('#leave_date').val()
        },
        success: function (e) {
            response = JSON.parse(e);
            if (response.has_error == false) {
                $.post({
                    url: baseUrl + 'request/verify_file',
                    data: {
                        ID: selected_ID,
                    },
                    success: function (response) {
                        // load_attachements();
                    }
                })
                $('#view_req_verif_modal').modal('hide');
                toastr.success(response.message);
            }
            else {
                toastr.error(response.message);
            }
        }
    })
});


$(document).on('change', '#request_filter_date', function () {
    load_attachements();
});

var hold_date_range = null;
var hold_faculty_id = null;
function view_dtr(element) {
    hold_date_range = element.getAttribute('data-schedule');
    hold_faculty_id = element.getAttribute('data-faculty_id')

    $.ajax({
        url: 'request/load_request_dtr',
        type: 'POST',
        data: {
            facultyID: element.getAttribute('data-faculty_id'),
            date_range: element.getAttribute('data-schedule')
        },
        success: function (data) {
            // Update the content of the element with id 'load_file_table'
            $('#load_dtr_modal').html(data);
            $('#view_dtr_modal').modal('show');
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error('Error loading attachments:', textStatus, errorThrown);
        }
    });
}

function update_entry(element) {
    // console.log(element.closest('tr').querySelector('#time_in_am').value);
    let time_in_am = element.closest('tr').querySelector('#time_in_am').value;
    let time_out_am = element.closest('tr').querySelector('#time_out_am').value;
    let time_in_pm = element.closest('tr').querySelector('#time_in_pm').value;
    let time_out_pm = element.closest('tr').querySelector('#time_out_pm').value;

    let date_in_am = null
    if (element.closest('tr').querySelector('#dateTimeIn_am').value == "" && time_in_am != "") {
        date_in_am = element.closest('tr').querySelector('#date_default').value;
    }
    else {
        date_in_am = element.closest('tr').querySelector('#dateTimeIn_am').value;
    }

    let date_out_am = null;
    if (element.closest('tr').querySelector('#dateTimeOut_am').value == "" && time_out_am != "") {
        date_out_am = element.closest('tr').querySelector('#date_default').value;
    }
    else {
        date_out_am = element.closest('tr').querySelector('#dateTimeOut_am').value;
    }

    let date_in_pm = null;
    if (element.closest('tr').querySelector('#dateTimeIn_pm').value == "" && time_in_pm != "") {
        date_in_pm = element.closest('tr').querySelector('#date_default').value;
    }
    else {
        date_in_pm = element.closest('tr').querySelector('#dateTimeIn_pm').value;
    }

    let date_out_pm = null;
    if (element.closest('tr').querySelector('#dateTimeOut_pm').value == "" && time_out_pm != "") {
        date_out_pm = element.closest('tr').querySelector('#date_default').value;
    }
    else {
        date_out_pm = element.closest('tr').querySelector('#dateTimeOut_pm').value;
    }


    let ID = element.getAttribute('data-log_id');

    // console.log(time_in_pm);
    // return;
    $.ajax({
        url: 'request/update_entry',
        type: 'POST',
        data: {
            time_in_am: time_in_am,
            time_out_am: time_out_am,
            time_in_pm: time_in_pm,
            time_out_pm: time_out_pm,

            date_in_am: date_in_am,
            date_out_am: date_out_am,
            date_in_pm: date_in_pm,
            date_out_pm: date_out_pm,

            ID: ID
        },
        success: function (data) {
            e = JSON.parse(data);
            if (e.has_error == false) {
                toastr.success(e.message);
                setTimeout(function () {
                    $.ajax({
                        url: 'request/load_request_dtr',
                        type: 'POST',
                        data: {
                            facultyID: hold_faculty_id,
                            date_range: hold_date_range
                        },
                        success: function (data) {
                            // Update the content of the element with id 'load_file_table'
                            $('#load_dtr_modal').html(data);
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            console.error('Error loading attachments:', textStatus, errorThrown);
                        }
                    });
                }, 2000);
            }
            else {
                toastr.error(e.message);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error('Error loading attachments:', textStatus, errorThrown);
        }
    });
}

function verify_dtr_request(element) {
    let ID = element.getAttribute('data-id');
    $.post({
        url: baseUrl + 'request/verify_dtr_request',
        data: {
            ID: ID,
        },
        success: function (response) {
            toastr.success('Request Verified Successfuly');
            load_dtr_request();
        }
    })
    // alert(ID);
}



var load_attachements = () => {
    $.ajax({
        url: 'request/load_files',
        type: 'POST',
        data: {
            date_filter: $('#request_filter_date').val(),
        },
        success: function(data) {
            // Update the content of the element with id 'load_file_table'
            $('#load_file_table').html(data);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Error loading attachments:', textStatus, errorThrown);
        }
    });
};

var load_dtr_request = () => {
    $.ajax({
        url: 'request/load_dtr_requests',
        type: 'POST',
        success: function(data) {
            // Update the content of the element with id 'load_dtr_verify'
            $('#load_dtr_verify').html(data);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Error loading DTR requests:', textStatus, errorThrown);
        }
    });
};


$(document).ready(function () {
    load_attachements();
    load_dtr_request();
});

function view_file(element){
    // alert(element.getAttribute('data-id'));
    let ID = element.getAttribute('data-id');
    $.post({
        url: baseUrl + 'request/view_file',
        data: {
            ID: ID,
        },        
        success: function(response){
            $('#view_modal').modal('show');
            $('#modal_content').html(response);                  
        }
    })
}

function verify_file(element){
    // alert(element.getAttribute('data-id'));
    let ID = element.getAttribute('data-id');
    $.post({
        url: baseUrl + 'request/verify_file',
        data: {
            ID: ID,
        },        
        success: function(response){
            toastr.success('Request Verified Successfuly');   
            load_attachements();          
        }
    })
}

function view_dtr(element){
    alert(element.getAttribute('data-faculty_id') + " " + element.getAttribute('data-schedule'));
}
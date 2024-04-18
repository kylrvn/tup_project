
var load_attachements = () => {
    $(document).gmLoadPage({
        url: 'request/load_files',
        load_on: '#load_file_table'
    });
}

var load_dtr_request = () => {
    $(document).gmLoadPage({
        url: 'request/load_dtr_requests',
        load_on: '#load_dtr_verify'
    });
}

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

var load_attachements = () => {
    $(document).gmLoadPage({
        url: 'request/load_files',
        load_on: '#load_file_table'
    });
}

// var load_verified_attachements = () => {
//     $(document).gmLoadPage({
//         url: 'schedule/load_faculty',
//         load_on: '#load_faculty_table'
//     });
// }

$(document).ready(function () {
    load_attachements();
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
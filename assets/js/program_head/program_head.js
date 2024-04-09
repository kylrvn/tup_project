var load_dtr_schedule = () => {
    $(document).gmLoadPage({
        url: 'program_head/load_dtr_schedule',
        load_on: '#load_dtr_schedule'
    });
}
// var load_calendar = () => {
//     // alert();
//     $(document).gmLoadPage({
//         url: 'program_head/get_calendar',
//         load_on: '#load_page'
//     });
// }
$(document).ready(function () {
    load_dtr_schedule();
    // load_calendar();
    //  alert();
    
});
function load_calendar(element){
    $.ajax({
        type: 'POST',
        url: baseUrl + 'program_head/load_calendar',
        data: {
            faculty_id: element.getAttribute('data-id'),
        },
        success: function (data) {
            $('#modal_data').html(data);
            $('#calendar_modal').modal('show');
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}
function load_dtr(element){
    $.ajax({
        type: 'POST',
        url: baseUrl + 'program_head/get_dtr',
        data: {
            faculty_id: element.getAttribute('data-id'),
        },
        success: function (data) {
            $('#modal_data2').html(data);
            $('#dtr_modal').modal('show');
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}
$('#approveBtn').click(function() {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    var checkedData = [];

    checkboxes.forEach(function(checkbox){
        if(checkbox.checked){
            var data = {};
            data.dataID = checkbox.getAttribute('data-ID');
            data.facultyID = $('#faculty_id').val();
            checkedData.push(data);
        }
    });

    // console.log(checkedData);
    // return
    $.post('program_head/service/Program_head_service/approve_dtr_schedule', {
        data: checkedData
    }, function(response) {
        // Handle success response
        var jsonResponse = JSON.parse(response);
        if(jsonResponse.has_error == false){
            toastr.success(jsonResponse.message);
        } else {
            toastr.error(jsonResponse.message); 
        }
    }).fail(function(xhr, status, error) {
        // Handle any errors that occur during the AJAX request
        var errorMessage = xhr.responseJSON ? xhr.responseJSON.message : "An error occurred.";
        toastr.error(errorMessage);
    });
});
var load_schedule = () => {
    $(document).gmLoadPage({
        url: 'schedule/load_faculty',
        load_on: '#load_faculty_table'
    });
}

$(document).ready(function () {
    load_schedule();
});

function load_calendar(element){
    $.ajax({
        type: 'POST',
        url: baseUrl + 'schedule/load_calendar',
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




    

    
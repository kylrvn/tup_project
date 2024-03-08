var load_schedule = () => {
    $(document).gmLoadPage({
        url: 'faculty_schedule/load_grid',
        load_on: '#load_schedule'
    });
}

$(document).ready(function () {
    load_schedule();
});

$('#save_schedule').click(function () {
    // alert($('#start_time').val());
    $.post({
        url: 'faculty_schedule/service/Faculty_schedule_service/save_schedule',

        data: {
            faculty_id: $('#faculty_id').val(),
            subject: $('#subject').val(),
            day: $('#day').val(),
            room: $('#room').val(),
            start_time: $('#start_time').val(),
            end_time: $('#end_time').val(),
        },
    })
});

$('#Update').click(function () {
    $.post({
        url: 'faculty_schedule/service/Faculty_schedule_service/update_schedule',

        data: {
            ID: $('#ID').val(),
            faculty_id: $('#faculty_id').val(),
            subject: $('#subject').val(),
            day: $('#day').val(),
            room: $('#room').val(),
            start_time: $('#start_time').val(),
            end_time: $('#end_time').val(),
        },


        success: function (e) {
            var e = JSON.parse(e);
            if (e.has_error == false) {
                toastr.success(e.message);
                setTimeout(function () {
                    window.location.reload();
                }, 1000);

            } else {
                toastr.error(e.message);
            }
        },
    })
});


function update(element) {
    //alert(element.getAttribute('data-Start_time'));
    document.getElementById('ID').value = element.getAttribute('data-ID');
    document.getElementById('subject').value = element.getAttribute('data-subject');
    document.getElementById('day').value = element.getAttribute('data-day');
    document.getElementById('room').value = element.getAttribute('data-room');
    document.getElementById('start_time').value = element.getAttribute('data-start_time');
    document.getElementById('end_time').value = element.getAttribute('data-end_time');
    document.getElementById('Update').removeAttribute('hidden');
    // console.log();
}


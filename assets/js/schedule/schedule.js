
var calendar;
// For Full Calendar
$(function () {

    function ini_events(ele) {
        ele.each(function () {

            // create an Event Object (https://fullcalendar.io/docs/event-object)
            // it doesn't need to have a start or end
            var eventObject = {
                title: $.trim($(this).text()) // use the element's text as the event title
            }

            // store the Event Object in the DOM element so we can get to it later
            $(this).data('eventObject', eventObject)

            // make the event draggable using jQuery UI
            $(this).draggable({
                zIndex: 1070,
                revert: true, // will cause the event to go back to its
                revertDuration: 0 //  original position after the drag
            })

        })
    }

    /* initialize the calendar
     -----------------------------------------------------------------*/
    var Calendar = FullCalendar.Calendar;
    var Draggable = FullCalendar.Draggable;

    var containerEl = document.getElementById('external-events');
    var checkbox = document.getElementById('drop-remove');
    var calendarEl = document.getElementById('calendar');

    new Draggable(containerEl, {
        itemSelector: '.external-event',
        eventData: function (eventEl) {
            return {
                title: eventEl.innerText,
                backgroundColor: window.getComputedStyle(eventEl, null).getPropertyValue('background-color'),
                borderColor: window.getComputedStyle(eventEl, null).getPropertyValue('background-color'),
                textColor: window.getComputedStyle(eventEl, null).getPropertyValue('color'),
            };
        }
    });

    calendar = new Calendar(calendarEl, {
        headerToolbar: {
            right: 'timeGridWeek'
        },
        initialView: 'timeGridWeek',
        themeSystem: 'bootstrap',
        slotDuration: '00:15:00',
        slotMinTime: '06:00',
        slotMaxTime: '20:00',
        height: 'auto',

        events: [
            {
                title: 'Lunch',
                startTime: '12:00',
                endTime: '13:00',
                daysOfWeek: [0, 1, 2, 3, 4, 5, 6], // Monday
                backgroundColor: '#BDBDBD',
                borderColor: '#BDBDBD',
                editable: false
            }
        ],
        editable: true,
        droppable: true,
        drop: function (info) {
            if (checkbox.checked) {
                info.draggedEl.parentNode.removeChild(info.draggedEl);
            }
        }
    });

    calendar.render();

    $('#calendar').fullCalendar();

    /* ADDING EVENTS */
    var currColor = '#3c8dbc' //Red by default
    // Color chooser button
    $('#color-chooser > li > a').click(function (e) {
        e.preventDefault()
        // Save color
        currColor = $(this).css('color')
        // Add color effect to button
        $('#add-new-event').css({
            'background-color': currColor,
            'border-color': currColor
        })
    })

})

$(function () {
    $('input[name="schoolyearrange"]').daterangepicker({
        opens: 'left', // or 'right' for RTL support
        startDate: moment().subtract(1, 'years').startOf('year'),
        endDate: moment().endOf('year'),
        showDropdowns: true,
        linkedCalendars: true,
        locale: {
            format: 'YYYY',
            separator: ' to ',
            applyLabel: 'Apply',
            cancelLabel: 'Cancel',
            fromLabel: 'From',
            toLabel: 'To',
            customRangeLabel: 'Custom',
            daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
            monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            firstDay: 1
        },
        ranges: {
            'Current School Year': [moment().subtract(1, 'years').startOf('year'), moment().endOf('year')],
            'Next School Year': [moment().startOf('year'), moment().add(1, 'years').endOf('year')]
        }
    });
});

var load_schedule = () => {
    $(document).gmLoadPage({
        url: 'schedule/load_faculty',
        load_on: '#load_faculty_table'
    });
}

var load_dynamic_calendar = () => {
    $.ajax({
        url: baseUrl + 'schedule/load_dynamic_calendar',
        method: 'GET',
        success: function (data) {
            $('#load_faculty_table').html(data);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error(`AJAX error: ${textStatus}`, errorThrown);
        }
    });
}

$(document).ready(function () {
    load_schedule();
});

function testing(element) {

}

// function load_calendar(element) {
//     $.ajax({
//         type: 'POST',
//         url: baseUrl + 'schedule/load_calendar',
//         data: {
//             faculty_id: element.getAttribute('data-id'),
//         },
//         success: function (data) {
//             $('#modal_data').html(data);
//             $('#calendar_modal').modal('show');
//         },
//         error: function (xhr, status, error) {
//             console.error(xhr.responseText);
//         }
//     });
// }

function load_calendar(element) {
    // alert(element.getAttribute('data-id'));
    // return
    $.ajax({
        type: 'POST',
        url: baseUrl + 'schedule/load_calendar',
        data: {
            faculty_id: element.getAttribute('data-id'),
        },
        success: function (data) {

            let e = JSON.parse(data);
            load_dynamic_calendar();


            setTimeout(() => {
                e.forEach(element => {
                    var newEvent = {
                        title: element.Subject_name,
                        startTime: element.Start_time,
                        endTime: element.End_time,
                        daysOfWeek: element.Day == "sunday" ? [0] : element.Day == "monday" ? [1] : element.Day == "tuesday" ? [2] : element.Day == "wednesday" ? [3] : element.Day == "thursday" ? [4] : element.Day == "friday" ? [5] : element.Day == "saturday" ? [6] : "",
                        backgroundColor: element.color,
                        borderColor: element.color,
                        editable: false
                    };
                    calendar.addEvent(newEvent);
                });
            }, 1000);

            calendar.render();

        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}

$('#save_exam_sched').click(function () {
    // console.log(
    //     $('#reservation').val() + '\n' +
    //     $('#school_year').val() + '\n' +
    //     $('#term').val()
    // );
    $.ajax({
        type: 'POST',
        url: baseUrl + 'schedule/service/Schedule_service/save_exam_sched',
        data: {
            date_range: $('#reservation').val(),
            school_year: $('#school_year').val(),
            term: $('#term').val(),
        },
        success: function (data) {
            let e = JSON.parse(data);
            toastr.success(e.message);
        },
    });

});

$('#print_button').click(function () {
    // alert(baseUrl);
    // return;
    $('#print_calendar').printThis({
        debug: false,
        importCSS: true,
        importStyle: true,
        copyTagClasses: true,
        loadCSS: baseUrl + "assets/theme/adminlte/AdminLTE/plugins/fullcalendar/main.css",
    });
});





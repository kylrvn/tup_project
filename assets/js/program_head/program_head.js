var calendar;
// For Full Calendar
$(function () {

    function ini_events(ele) {
        ele.each(function () {

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
    var calendarEl = document.getElementById('calendar_schedule');

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
        headerToolbar: null,
        initialView: 'timeGridWeek',
        hiddenDays: [0],
        themeSystem: 'bootstrap',
        slotDuration: '00:15:00',
        slotMinTime: '08:00',
        slotMaxTime: '21:00',
        allDaySlot: false,
        height: 'auto',
        width: 'auto',

        views: {
            timeGridWeek: {
                dayHeaderFormat: { weekday: 'long' }
            }
        },

        events: [
            {
                title: 'Lunch Break',
                startTime: '12:00',
                endTime: '13:00',
                daysOfWeek: [0, 1, 2, 3, 4, 5, 6], // Monday
                backgroundColor: '#A2A2A2',
                borderColor: '#A2A2A2',
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

    $('#calendar_schedule').fullCalendar();

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

var load_dtr_schedule = () => {
    $(document).gmLoadPage({
        url: 'program_head/load_dtr_schedule',
        load_on: '#load_dtr_schedule'
    });
}

var load_dynamic_calendar = () => {
    $.ajax({
        url: baseUrl + 'schedule/load_dynamic_calendar',
        method: 'GET',
        success: function (data) {
            $('#load_dtr_schedule').html(data);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error(`AJAX error: ${textStatus}`, errorThrown);
        }
    });
}

$(document).ready(function () {
    load_dtr_schedule();
    // load_calendar();
    //  alert();

});
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
                        title: element.subject_code 
                        + '\n' 
                        + element.Subject_name
                        + '\n'
                        + '\n'
                        + element.Section
                        + '\n'
                        + element.Lname
                        + '\n'
                        + element.Room,
                        startTime: element.Start_time,
                        endTime: element.End_time,
                        daysOfWeek: element.Day == "sunday" ? [0] : element.Day == "monday" ? [1] : element.Day == "tuesday" ? [2] : element.Day == "wednesday" ? [3] : element.Day == "thursday" ? [4] : element.Day == "friday" ? [5] : element.Day == "saturday" ? [6] : "",
                        backgroundColor: element.color,
                        textColor: 'black',
                        borderColor: 'black',
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
function load_dtr(element) {
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
$('#approveBtn').click(function () {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    var checkedData = [];

    checkboxes.forEach(function (checkbox) {
        if (checkbox.checked) {
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
    }, function (response) {
        // Handle success response
        var jsonResponse = JSON.parse(response);
        if (jsonResponse.has_error == false) {
            toastr.success(jsonResponse.message);
        } else {
            toastr.error(jsonResponse.message);
        }
    }).fail(function (xhr, status, error) {
        // Handle any errors that occur during the AJAX request
        var errorMessage = xhr.responseJSON ? xhr.responseJSON.message : "An error occurred.";
        toastr.error(errorMessage);
    });
});

var schoolYear = null;
var schoolTerm = null;
var facultyID = null;

function confirmation(element) {

    schoolYear = element.getAttribute('data-year');
    schoolTerm = element.getAttribute('data-term');
    facultyID = element.getAttribute('data-id');

    $('#confirmation').modal('show');
}

$('#confirm_yes').click(function () {
    // alert(schoolYear + " " + schoolTerm + " " + facultyID);

    $.ajax({
        type: 'POST',
        url: baseUrl + 'program_head/approve_schedule',
        data: {
            facultyID: facultyID,
            schoolYear: schoolYear,
            schoolTerm: schoolTerm,
        },
        success: function (data) {
            let e = JSON.parse(data);
            if (e.has_error == false) {
                toastr.success(e.message);
                $('#confirmation').modal('hide');
                load_dtr_schedule();
            }
            else {
                toastr.error(e.message);
            }
        },
    });
});

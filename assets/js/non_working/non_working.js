var baseUrl = $('#baseUrl').val();
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
            left: 'prev,next prevYear,nextYear',
            center: 'title',
            right: 'dayGridMonth,dayGridWeek'
        },
        initialView: 'dayGridMonth',
        themeSystem: 'bootstrap',
        height: '120vh',
        allDaySlot: false,

        views: {
            timeGridWeek: {
                dayHeaderFormat: { weekday: 'long' }
            }
        },

        events: [

        ],

        eventClick: function (info) {
            evenClickHandler(info.event);
        },
        eventResizableFromStart: false,
        editable: true,
        droppable: true,
        drop: function (info) {
            if (checkbox.checked) {
                info.draggedEl.parentNode.removeChild(info.draggedEl);
            }
        },
        eventResize: function (info) {
            info.revert();
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

});

var titleFlag = null;
var dateFlag = null;
function evenClickHandler(event) {
    // alert('Event: ' + event.title);

    const date = new Date(event.start);

    const months = [
        "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];

    const month = months[date.getMonth()];
    const day = date.getDate();
    const year = date.getFullYear();

    const formattedDate = `${month} ${day.toString().padStart(2, '0')}, ${year}`;

    document.getElementById('eventTitle').innerHTML = event.title;
    document.getElementById('eventDate').innerHTML = formattedDate;

    titleFlag = event.title;
    dateFlag = formattedDate;

    $('#view_event').modal('show');

    // console.log('Event start: ' + event.start);
    // console.log('Event end: ' + event.end);
}

function deleteEvent(element) {
    // alert(titleFlag + " " + dateFlag);
    $.ajax({
        type: 'POST',
        url: baseUrl + 'schedule/service/schedule_service/delete_event',
        data: {
            title: titleFlag,
            date: dateFlag
        },
        success: function (data) {
            e = JSON.parse(data);
            if (e.has_error == false) {
                toastr.success(e.message);
                setTimeout(function () {
                    
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

function formatDate(dateString) {
    if (dateString === null) {
        return null;
    }
    console.log(dateString);

    const date = new Date(dateString);
    date.setHours(8, 0, 0, 0);
    // date.setDate(date.getDate() + 1);

    console.log(date.toISOString().split('T')[0]);
    return date.toISOString().split('T')[0];
}

$('#save_dates').click(function () {
    let allEvents = calendar.getEvents();
    let eventsArray = [];

    allEvents.forEach(function (event) {
        let eventTitle = event.title;
        let startDate = event.start;
        let endDate = event.end;

        eventsArray.push({
            title: eventTitle,
            start: formatDate(startDate),
            end: formatDate(endDate)
        });

        // console.log('Event Title:', eventTitle);
        // console.log('Start Date:', formatDate(startDate)); // Format start date as needed
        // console.log('End Date:', formatDate(endDate)); // Format end date as needed
    });

    // console.log(eventsArray);

    $.ajax({
        url: baseUrl + 'schedule/service/schedule_service/save_events',
        method: 'POST',
        data: {
            eventsArray: eventsArray,
        },
        success: function (data) {
            toastr.success("Dates Saved Successfully");
            setTimeout(function () {
                window.location.reload();
            }, 1000)
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error(`AJAX error: ${textStatus}`, errorThrown);
        }
    });

});

function load_calendar() {
    // alert(element.getAttribute('data-id'));
    // return
    $.ajax({
        type: 'POST',
        url: baseUrl + 'schedule/get_all_events',
        success: function (data) {

            let e = JSON.parse(data);

            console.log(e);

            setTimeout(() => {
                e.forEach(element => {
                    var startDate = new Date(element.from_date);
                    var endDate = new Date(element.to_date);
                    var newEvent = {
                        title: element.type,
                        start: startDate,
                        end: endDate,
                        backgroundColor: '#6F7588',
                        borderColor: '#6F7588',
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

// <----------------------------------------------> DOM READY HERE <---------------------------------------------->
$(document).ready(function () {
    load_calendar();
});

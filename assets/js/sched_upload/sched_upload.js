function check_am_time(inputElement) {
    var inputValue = inputElement.value;

    var inputTime = new Date("2000-01-01T" + inputValue);

    if (inputTime.getHours() >= 12 && !(inputTime.getHours() === 12 && inputTime.getMinutes() === 0)) {
        // alert("Please enter a valid AM time (excluding 12:00 AM).");
        toastr.error('Please enter a valid AM time (excluding 12:00 AM).');
        inputElement.value = "";
    }
    calculateTotalTime()
}

function check_pm_time(inputElement) {
    var inputValue = inputElement.value;

    var inputTime = new Date("2000-01-01T" + inputValue);

    if (inputTime.getHours() < 13 || inputTime.getHours() > 21) {
        // alert("Please enter a valid time between 1:00 PM and 9:00 PM.");
        toastr.error('Please enter a valid time between 1:00 PM and 9:00 PM.');
        inputElement.value = "";
    }
    calculateTotalTime()
}

function calculateTotalTime() {
    var amStartTime = $('#start').val();
    var amEndTime = $('#end').val();
    var pmStartTime = $('#pm_start').val();
    var pmEndTime = $('#pm_end').val();

    var amStartDate = new Date('2000-01-01 ' + amStartTime);
    var amEndDate = new Date('2000-01-01 ' + amEndTime);
    var pmStartDate = new Date('2000-01-01 ' + pmStartTime);
    var pmEndDate = new Date('2000-01-01 ' + pmEndTime);

    // Calculate time differences in milliseconds
    var amTimeDiff = amEndDate - amStartDate;
    var pmTimeDiff = pmEndDate - pmStartDate;

    // Calculate total time in hours
    var totalHours = (amTimeDiff + pmTimeDiff) / (1000 * 60 * 60);

    // Display the total time in the desired format
    document.getElementById('total_time').value = totalHours.toFixed(1) + ' hours';
}


var load_schedule = () => {
    $(document).gmLoadPage({
        url: 'faculty_schedule/load_grid',
        load_on: '#load_schedule'
    });
}

$(document).ready(function () {
    load_schedule();
});

function add_row_am(element) {

    var day = element.getAttribute('data-day');

    var capitalizedFirstLetter;
    if(day == "thursday"){
        capitalizedFirstLetter = day.substring(0, 2).toUpperCase();;
    }
    else{
        capitalizedFirstLetter = day.charAt(0).toUpperCase();
    }

    var tbody = document.getElementById("table_" + day);

    var newRow = document.createElement("tr");

    newRow.innerHTML = `
    <td class="text-left">
        <label>`+capitalizedFirstLetter+`</label>
    </td>
    <td>
        &nbsp;
        <input type="text" hidden name="day" value="`+day+`">
    </td>
    <td class="text-center">
        <b>AM</b>
    </td>
    <td class="text-center">
        <input type="text" hidden name="time_frame" value="AM">
        <input type="time" name="start" onchange="check_am_time(this)">
        TO
        <input type="time" name="end" onchange="check_am_time(this)">
        <br>
    </td>
    <td class="text-center">
        <input type="text" name="subject" style="width:100%;" placeholder="ENTER SUBJECT HERE">
        <br>
    </td>
    <td class="text-center">
        <input type="text" name="room" style="width:60%;" placeholder="ENTER ROOM HERE">
        <br>
    </td>
    <td class="text-center">
        &nbsp;
    </td>
    `;

    tbody.appendChild(newRow);

}


function add_row_pm(element) {

    var day = element.getAttribute('data-day');

    var capitalizedFirstLetter;
    if(day == "thursday"){
        capitalizedFirstLetter = day.substring(0, 2).toUpperCase();;
    }
    else{
        capitalizedFirstLetter = day.charAt(0).toUpperCase();
    }

    var tbody = document.getElementById("table_" + day);

    var newRow = document.createElement("tr");

    newRow.innerHTML = `
    <td class="text-left">
        <label>`+capitalizedFirstLetter+`</label>
    </td>
    <td>
        &nbsp;
        <input type="text" hidden name="day" value="`+day+`">
    </td>
    <td class="text-center">
        <b>PM</b>
    </td>
    <td class="text-center">
        <input type="text" hidden name="time_frame" value="PM">
        <input type="time" name="start" onchange="check_pm_time(this)">
        TO
        <input type="time" name="end" onchange="check_pm_time(this)">
        <br>
    </td>
    <td class="text-center">
        <input type="text" name="subject" style="width:100%;" placeholder="ENTER SUBJECT HERE">
        <br>
    </td>
    <td class="text-center">
        <input type="text" name="room" style="width:60%;" placeholder="ENTER ROOM HERE">
        <br>
    </td>
    <td class="text-center">
        &nbsp;
    </td>
    `;

    tbody.appendChild(newRow);
}

$('#save_schedule').click(function () {

    // Day Flag
    var day = $('[name="day"]').map(function () {
        return $(this).val();
    }).get();

    // Start/End Data
    var time_frame = $('[name="time_frame"]').map(function () {
        return $(this).val();
    }).get();
    var start = $('[name="start"]').map(function () {
        return $(this).val();
    }).get();
    var end = $('[name="end"]').map(function () {
        return $(this).val();
    }).get();

    // Subject/Room Data
    var subject = $('[name="subject"]').map(function () {
        return $(this).val();
    }).get();
    var room = $('[name="room"]').map(function () {
        return $(this).val();
    }).get();

    // alert(time_frame);

    $.ajax({
        type: 'POST',
        url: baseUrl + 'faculty_schedule/service/Faculty_schedule_service/save_schedule',
        data: {
            day: day,
            time_frame: time_frame,
            start_time: start,
            end_time: end,
            subject: subject,
            room: room,
        },
        success: function (data) {
            toastr.success('Schedule Submitted Successfully');
        },
    });
});








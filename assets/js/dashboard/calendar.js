
$('#search_btn').click(function() {
    // Retrieve the selected date
    var selectedDate = $('#search_date').val();

    // Perform an AJAX request to fetch the schedule for the selected date
    $.post({
        url: 'dashboard/Dashboard/filter_calendar',
        data: {
            date: selectedDate,
        },
        success: function(response) {
            // Update the schedule container with the new schedule data
            $('#schedule_container').html(response);
        },
        error: function(xhr, status, error) {
            // Handle any errors that occur during the AJAX request
            console.error(xhr.responseText);
        }
    });
});


$('#search_btn').click(function() {
    var selectedDate = $('#search_date').val();
    $.post({
        url: 'dashboard/Dashboard/filter_calendar',
        data: {
            date: selectedDate,
        },
        success: function(response) {
            $('#schedule_container').html(response);
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
});




var load_subjects = () => {
    $(document).gmLoadPage({
        url: 'subjects/load_subjects',
        load_on: '#load_subjects'
    });
}


$(document).ready(function () {
    load_subjects();
});

$(document).on('click', '#add_subject', function () {
    if ($('#subject_name').val() == null || $('#subject_name').val() == "") {
        toastr.error("Subject Name is Empty");
        return
    }
    else if ($('#color').val() == null || $('#color').val() == "") {
        toastr.error("Color Value is Empty");
        return
    }
    else if ($('#department').val() == null || $('#department').val() == "" || $('#department').val() == null) {
        toastr.error("No Department Selected");
        return
    }
    else {
        $.ajax({
            url: baseUrl + 'subjects/service/Subjects_service/add_subject',
            type: 'POST',
            data: {
                subject_name: $('#subject_name').val(),
                color: $('#color').val(),
                department: $('#department').val(),
                status: $('#subject_status').val(),
            },

            success: function (e) {
                var e = JSON.parse(e);
                if (e.has_error == false) {
                    toastr.success(e.message);
                    load_subjects();
                    document.getElementById('subject_name').value = "";
                    document.getElementById('color').value = "";
                    document.getElementById('department').value = "";
                    document.getElementById('subject_status').value = "";
                } else {
                    toastr.error(e.message);
                }
            },
        })
    }
});



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
    else if ($('#subject_code').val() == null || $('#subject_code').val() == "") {
        toastr.error("Subject Code is Empty");
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
                subject_code: $('#subject_code').val(),
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
                    document.getElementById('subject_code').value = "";
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

$(document).on('click', '#update_subject', function () {
    document.getElementById('update_subject').setAttribute('hidden', true);
    document.getElementById('add_subject').removeAttribute('hidden');

    if ($('#subject_name').val() == null || $('#subject_name').val() == "") {
        toastr.error("Subject Name is Empty");
        return
    }
    else if ($('#subject_code').val() == null || $('#subject_code').val() == "") {
        toastr.error("Subject Code is Empty");
        return
    }
    else if ($('#color').val() == null || $('#color').val() == "") {
        toastr.error("Color Value is Empty");
        return
    }
    // else if ($('#department').val() == null || $('#department').val() == "" || $('#department').val() == null) {
    //     toastr.error("No Department Selected");
    //     return
    // }
    else {
        $.ajax({
            url: baseUrl + 'subjects/service/Subjects_service/update_subject',
            type: 'POST',
            data: {
                id: $('#subject_id').val(),
                subject_name: $('#subject_name').val(),
                subject_code: $('#subject_code').val(),
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
                    document.getElementById('subject_code').value = "";
                    document.getElementById('color').value = "";
                    document.getElementById('subject_status').value = "";
                } else {
                    toastr.error(e.message);
                }
            },
        })
    }

});


function click_subject(element) {

    let ID = element.getAttribute('data-ID');
    let subject = element.getAttribute('data-subject');
    let code = element.getAttribute('data-code');
    let color = element.getAttribute('data-color');
    let department = element.getAttribute('data-department');
    let status = element.getAttribute('data-status');

    document.getElementById('subject_name').value = subject;
    document.getElementById('subject_code').value = code;
    document.getElementById('subject_id').value = ID;

    document.getElementById('color').value = color;
    document.getElementById('color_box').style.color = color;

    document.getElementById('department').selectedIndex = department;
    document.getElementById('subject_status').selectedIndex = status == 1 ? 1 : status == 0 ? 2 : 0;

    document.getElementById('update_subject').removeAttribute('hidden');
    document.getElementById('add_subject').setAttribute('hidden', true);
}
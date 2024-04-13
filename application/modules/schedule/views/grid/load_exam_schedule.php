<?php
exam_schedule_header();
// var_dump($department_id);
?>

<input type="hidden" id="faculty_id" value="<?=$faculty_id?>">
<input type="hidden" id="department_id" value="<?=$department_id?>">

<div class="row">
    <div class="col-2">
        <div class="col-12 d-flex justify-content-center">
            <?= $calendar ?>
        </div>
    </div>
    <div class="col-9">
        <div class="row">
            <div class="col-4">
                <label>Exam Date Range:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="far fa-calendar-alt"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control float-right" id="reservation">
                </div>
            </div>
            <div class="col-4">
                <label style="font-size:100%;">For School Year:</label>
                <input type="text" class="form-control" name="schoolyearrange" id="school_year"
                    style="text-align:center; font-size:130%; font-weight:550;" />
            </div>
            <div class="col-4">
                <label style="font-size:100%;">School Term:</label>
                <select id="term" class="form-control" style="text-align:center; font-size:130%; font-weight:550;">
                    <option value="" disabled selected>Select Term</option>
                    <option value="1st">1st Term</option>
                    <option value="2nd">2nd Term</option>
                    <option value="3rd">3rd Term</option>
                </select>
            </div>
        </div>
    </div>
    <div class="col-1">
        <div class="row">
            <label>&nbsp;</label>
            <button class="form-control btn btn-success" id="save_exam_sched">Save</button>
        </div>
    </div>
</div>

<?php
exam_schedule_header();
?>
<script>
     //Date range picker
     $('#reservation').daterangepicker()

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

$('#save_exam_sched').click(function () {
    $.ajax({
        type: 'POST',
        url: baseUrl + 'schedule/service/Schedule_service/save_exam_sched',
        data: {
            faculty_id: $('#faculty_id').val(),
            department_id: $('#department_id').val(),

            date_range: $('#reservation').val(),
            school_year: $('#school_year').val(),
            term: $('#term').val(),
        },
        success: function (data) {
            let e = JSON.parse(data);
            toastr.success(e.message);
            $('#exam_sched_modal').modal('hide');
        },
    });
});
</script>

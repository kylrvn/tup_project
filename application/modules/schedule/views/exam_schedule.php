<?php
main_header(['exam_schedule']);
// var_dump($session);
?>

<head>
    <style>
    .custom-modal-width {
        max-width: 90%;
        /* Adjust the percentage or use a fixed pixel value as needed */
    }
    </style>
</head>
<!-- ############ PAGE START-->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1 class="m-0">Exam Schedule</h1>
            </div>
        </div>
    </div>
</div>


<div class="card card-default ml-3 mr-3">
    <div class="card-header" style="background-color:#9F3A3B; color: white;">
        <h3 class="card-title">Set Exam Schedule</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body" style="font-size:90%;" id="load_faculty_list">

    </div>
    <!-- /.card-body -->
    <div class="card-footer" style="background-color:#9F3A3B; color: white;">
        <!-- Footer Details Here -->
    </div>
</div>


<div class="modal fade" id="exam_sched_modal" tabindex="-1" role="dialog" aria-labelledby="calendar_modal">
    <div class="modal-dialog custom-modal-width calendar_modal-modal" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <b>FACULTY (NAME) SCHEDULE</b>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="load_set_exam">
                <!-- Content Loaded here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger flat " data-dismiss="modal">
                    <i class="fa fa-times"></i> Close
                </button>
            </div>
        </div>
    </div>
</div>





<!-- ############ PAGE END-->
<?php
main_footer();
?>
<script src="<?php echo base_url() ?>/assets/js/schedule/schedule.js"></script>
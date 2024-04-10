<?php
main_header(['exam_schedule']);
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
    <div class="card-body" style="font-size:90%;">
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
                        <select id="term" class="form-control"
                            style="text-align:center; font-size:130%; font-weight:550;">
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

    </div>
    <!-- /.card-body -->
    <div class="card-footer" style="background-color:#9F3A3B; color: white;">
        <!-- Footer Details Here -->
    </div>
</div>





<!-- ############ PAGE END-->
<?php
main_footer();
?>
<script src="<?php echo base_url() ?>/assets/js/schedule/schedule.js"></script>
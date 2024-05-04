<?php
main_header(['program_head']);
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
                <h1 class="m-0">Faculty DTR Schedule</h1>
            </div>
        </div>
    </div>
</div>


<!-- /.row -->
<div class="row" style="display:flex;">
    <div class="col-12">
        <div class="card">
            <div class="container col-12" id="load_dtr_schedule">
                <!-- Faculty Table Loaded Here -->
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="calendar_modal" tabindex="-1" role="dialog" aria-labelledby="calendar_modal">
    <div class="modal-dialog custom-modal-width calendar_modal-modal" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <b>FACULTY (NAME) SCHEDULE</b>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal_data">
                <div class="container">
                    <!-- Content Loaded here -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger flat " data-dismiss="modal">
                    <i class="fa fa-times"></i> Close
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="dtr_modal" tabindex="-1" role="dialog" aria-labelledby="dtr_modal">
    <div class="modal-dialog custom-modal-width dtr_modal-modal" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <b>FACULTY (NAME) SCHEDULE</b>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal_data2">
                <div class="container">
                    <!-- Content Loaded here -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="approveBtn" class="btn btn-success flat ">
                    <i class="fa fa-times"></i> Approve
                </button>
                <button type="button" class="btn btn-danger flat " data-dismiss="modal">
                    <i class="fa fa-times"></i> Close
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="confirmation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header " style="background-color:#9F3A3B; color: white;">
                <b>Confirm Action:</b>
            </div>
            <div class="modal-body">
                <label>You're about to <b style="color:green">APPROVE</b> a schedule. please confirm action:</label>
            </div>
            <div class="modal-footer " style="background-color:#9F3A3B; color: white;">
                <button type="button" id="confirm_yes" class="btn btn-success flat ">
                    <i class="fa fa-times"></i> Approve
                </button>
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
<script src="<?php echo base_url() ?>/assets/js/program_head/program_head.js"></script>
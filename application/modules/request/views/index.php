<?php
main_header(['request']);
// var_dump($leaveType);
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
                <h1 class="m-0">Request/Attachments</h1>
            </div>
        </div>
    </div>
</div>


<!-- /.row -->
<div class="row" style="display:flex;">
    <div class="col-12">
        <div class="card">
            <div class="card-header" style="background-color:#9F3A3B; color: white;">
                <div class="row">
                    <div class="col-6">
                        <h3 class="card-title"><b>List of Request w/ Attachments</b></h3>
                    </div>
                    <div class="col-3">
                        &nbsp;
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>Date range:</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control float-right" id="request_filter_date">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <div class="container col-12" id="load_file_table">
                    <!-- Faculty Table Loaded Here -->
                </div>
            </div>
            <div class="card-footer" style="background-color:#9F3A3B; color: white;">
                <!-- Footer -->
            </div>

        </div>
    </div>
</div>

<div class="row" style="display:flex;">
    <div class="col-12">
        <div class="card">
            <div class="card-header" style="background-color:#9F3A3B; color: white;">
                <div class="row">
                    <div class="col-6">
                        <h3 class="card-title"><b>List DTR Verification Requests</b></h3>
                    </div>
                    <div class="col-3">
                        &nbsp;
                    </div>
                    <div class="col-3">
                        <!-- <div class="form-group">
                            <label>Date range:</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control float-right " id="dtr_filter_date">
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <div class="container col-12" id="load_dtr_verify">
                    <!-- Faculty Table Loaded Here -->
                </div>
            </div>
            <div class="card-footer" style="background-color:#9F3A3B; color: white;">
                <!-- Footer -->
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="view_dtr_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header " style="background-color:#9F3A3B; color: white;">
                <b>Edit DTR Entry:</b>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="load_dtr_modal">
                    <!-- Content Loaded Her via JS -->
                </div>
            </div>
        </div>
    </div>
</div>






<!-- ############ PAGE END-->
<?php
main_footer();
?>
<script src="<?php echo base_url() ?>/assets/js/request/request.js"></script>
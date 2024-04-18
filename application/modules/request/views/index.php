<?php
main_header(['request']);
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
    <div class="col-12" >
        <div class="card" >
            <div class="container col-12" id="load_file_table">
                <!-- Faculty Table Loaded Here -->
            </div>
        </div>
    </div>
</div>

<div class="row" style="display:flex;">
    <div class="col-12" >
        <div class="card" >
            <div class="container col-12" id="load_dtr_verify">
                <!-- Faculty Table Loaded Here -->
            </div>
        </div>
    </div>
</div>






<!-- ############ PAGE END-->
<?php
main_footer();
?>
<script src="<?php echo base_url() ?>/assets/js/request/request.js"></script>
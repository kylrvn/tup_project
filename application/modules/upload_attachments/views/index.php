<?php
main_header(['upload_attachments']);
// var_dump($category);
?>
<!-- ############ PAGE START-->
<style>
  /* Add your custom CSS here */
  @media screen and (max-width: 768px) {
    /* Adjustments for smaller screens */
    .card {
      width: 90%; /* Adjust width for smaller screens */
      margin-top: 3rem; /* Adjust margin for smaller screens */
    }
    .col-sm-2 {
      /* Leave the width unchanged for smaller screens */
    }
    .col-sm-10 {
      /* Leave the width unchanged for smaller screens */
    }
  }
</style>

<div class="card" style="max-width: 50rem; margin: 5rem auto; background-color:#9f3a3b;color:white">
  <div class="card-header">
    <h3 class="card-title">Submit Attachment File</h3>
  </div>
  <!-- /.card-header -->
  <!-- form start -->
  <form class="form-horizontal" enctype="multipart/form-data">
    <div class="card-body" style="background-color:#9f3a3b;">
      <div class="form-group row">
        <label for="date_upload" class="col-sm-2 col-form-label">Date:</label>
        <div class="col-sm-10">
          <input type="date" class="form-control" id="date_upload">
        </div>
      </div>
      <div class="form-group row">
        <label for="concernType" class="col-sm-2 col-form-label-sm">Type of Concern:</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="concernType" placeholder="Enter Type of Concern">
        </div>
      </div>
      <div class="form-group row">
        <label for="file_attachments" class="col-sm-2 col-form-label-sm">File Attachments:</label>
        <div class="col-sm-10">
          <div class="custom-file">
            <input type="file" id="file_attachments" class="custom-file-input">
            <label class="custom-file-label" for="exampleInputFile">Upload File Attachment</label>
          </div>
        </div>
      </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
      <button type="submit" id="submit_file_attachment" class="btn btn-default float-right">Submit</button>
    </div>
    <!-- /.card-footer -->
  </form>
</div>

<!-- ############ PAGE END-->
<?php
main_footer();
?>
<script src="<?php echo base_url() ?>/assets/js/upload_attachments/upload_attachments.js"></script>

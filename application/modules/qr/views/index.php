<?php
main_header(['QR']);
?>
<!-- ############ PAGE START-->
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
    /* Mobile styles */
@media only screen and (max-width: 600px) {
  /* CSS styles for mobile devices */
}

/* Tablet styles */
@media only screen and (min-width: 601px) and (max-width: 1024px) {
  /* CSS styles for tablets */
}

/* Desktop styles */
@media only screen and (min-width: 1025px) {
  /* CSS styles for desktops */
}
.container {
    max-width: 100%;
    padding: 20px;
    margin: 0 auto;
    background-color: #f0f0f0;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }

  /* Placeholder styles */
  .placeholder {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 300px;
    background-color: #ddd;
    border-radius: 5px;
  }
</style>
</head>
<body>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Scan QR Code</h1>
            </div>
        </div>
    </div>
</div>
<!-- Main content -->
<section class="content">
<div class="row ml-2">
            <div class="col-12 col-sm-6">
              <div class="form-group">
                  <label>Time In/Time Out</label>
                  <select class="form-control select" id="" style="max-width: 50%;padding:0;margin:0">
                    <option selected="selected">Select an Option</option>
                    <option value="">Time In</option>
                    <option value="">Time Out</option>
                  </select>
                </div>
              </div>
</div>
<div class="container">
    <div class="placeholder">
      <p>QR Scanner Placeholder</p>
    </div>
  </div>
</section>
</body>
<!-- ############ PAGE END-->
<?php
main_footer();
?>
<script src="<?php echo base_url() ?>/assets/js/qr/qr.js"></script>
<?php
main_header(['QR_faculty']);

?>


<!-- ############ PAGE START-->


<!-- <head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
<style>
  .container {
    max-width: 50%;
    margin: 150 auto;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    overflow: hidden;
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

  /* Label styles */
  .label {
    margin-top: 10px;
    /* Adjust spacing as needed */
    font-size: 18px;
    color: #333;
    text-align: center;
  }

  /* QR Code styles (for demonstration) */
  .qr-code {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 300px;
    /* Adjust as needed */
    background-color: #fff;
    /* Change to actual QR Code background color */
    /* Additional styles for the QR Code */
  }

  /* Responsive styles */
  @media only screen and (max-width: 600px) {

    /* Adjust container styles for smaller screens */
    .container {
      max-width: 100%;
      border-radius: 0;
    }
  }
</style>
<!-- </head> -->

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Faculty QR Code</h1>
      </div>
    </div>
  </div>
</div>
<div class="container">
  <div class="placeholder">
    <!-- <p>Placeholder for QR Code</p> -->
    <img id="qr-image" src="data:image/png;base64,<?= $base64Image ?>" alt="QR Code not generated. Contact the admin for this issue.">
  </div>
  <!-- Actual QR Code container (for demonstration) -->
  <!-- Replace this with your QR Code implementation -->
  <!-- <div class="qr-code">
      <img src="path_to_your_qr_code_image" alt="QR Code">
    </div> -->

</div>

<div class="label">
  <label><?= strtoupper(@$session->Fname) . ' ' . strtoupper(substr(@$session->Mname, 0, 1)) . '. ' . strtoupper(@$session->Lname) ?></label>
  <p><strong style="color:red">Note: </strong>You may save this QR code via screenshot or saving the image for future use. Keep in mind that the QR generation can be generated anytime. Communicate with your administrator if you have problems with the QR scanning.</p>
</div>

<!-- ############ PAGE END-->
<?php
main_footer();
?>
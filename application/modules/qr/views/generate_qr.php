<?php
main_header(['generate_qr']);
?>


<!-- ############ PAGE START-->


<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    /* Container styles */
    .container {
      max-width: 90%;
      margin: 150px auto;
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      text-align: center;
      /* Center align the content */
      padding: 20px;
    }

    /* Button styles */
    .btn-generate {
      padding: 10px 20px;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .btn-generate:hover {
      background-color: #0056b3;
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
</head>

<body>
  <div class="container">
    <h2>Generate QR Code</h2>
    <button type="button" class="btn btn-danger genqr" id="gen-qr">Generate QR Code</button>
  </div>

</body>

<!-- ############ PAGE END-->
<?php
main_footer();
?>

<script>
  $(document).on('click', '#gen-qr', function() {
    // $(".genqr").click(function() {
    // alert();
    var facultyarr = [];
    var faculty = <?php echo json_encode($details); ?>;
    faculty.forEach(function(data) {
      facultyarr.push(data.ID);
    });
    $.post({
      url: baseUrl + "qr/service/QR_service/generate_rn",
      // selector: '.form-control',
      data: {
        faculty: JSON.stringify(facultyarr),
      },
      success: function(e) {
        var e = JSON.parse(e);
        if (e.has_error == false) {
          toastr.success("QR GENERATED");
        } else {
          toastr.error(e.message);
        }
      },
    });
  });
</script>
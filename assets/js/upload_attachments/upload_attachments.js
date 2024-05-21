
    $('#submit_file_attachment').click(function(e) {
        e.preventDefault(); // Prevent the default form submission
        
        // Retrieve the selected date and concern type
        var selectedDate = $('#date_upload').val();
        var concernType = $('#concernType').val();
        var remarks = $('#remarks').val();
        // Retrieve the file
        var fileInput = document.getElementById('file_attachments');
        var file = fileInput.files[0];
        var filename = fileInput.files[0].name;
        // Create a FormData object to send data including the file
        var formData = new FormData();
        formData.append('date', selectedDate);
        formData.append('concernType', concernType);
        formData.append('remarks', remarks);
        formData.append('file', file);
        // console.log(selectedDate+' '+concernType+' '+file+' '+ filename);
        // return
        // Perform an AJAX request to submit the form data
        $.ajax({
            url: 'upload_attachments/service/Upload_attachments_service/upload_file_attachment',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(e) {
                toastr.success("File Uploaded successfully");
            },
            error: function(xhr, status, error) {
                // Handle any errors that occur during the AJAX request
                var errorMessage = xhr.responseJSON ? xhr.responseJSON.message : "An error occurred.";
                toastr.error(errorMessage);
            }
        });
    });

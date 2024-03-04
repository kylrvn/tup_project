$('#save_scan').click(function() {
    $.post({
         url: 'scan/service/Scan_service/check_validation',
       
        data: {
            faculty_no     : $('#faculty_no').val(),
        //     subject        : $('#subject').val(),
        //     day            : $('#day').val(),
        //     room           : $('#room').val(),
        //     start_time     : $('#start_time').val(),
        //     end_time       : $('#end_time').val(),
        },
        // success:function(e)
        //     {
        //         var e = JSON.parse(e);
        //         if(e.has_error == false){
        //             $('#modal-default').modal('hide');
        //             toastr.success(e.message);
        //             load_list();
        //             setTimeout(function(){
        //               window.location.reload();
        //           },2000); 
  
        //         } else {
        //           $('#List').attr('class', 'form-control inpt is-invalid');
        //           $('#modal-default').modal('hide');
        //           toastr.error(e.message); 
        //         }
        // },
    })
  });
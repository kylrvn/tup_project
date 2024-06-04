var load_schedule = () => {
    $(document).gmLoadPage({
        url: 'faculty_schedule/load_grid',
        load_on: '#load_schedule'
    });
}
var load_calendar = () => {
    // alert();
    $(document).gmLoadPage({
        url: 'dashboard/get_calendar',
        load_on: '#load_page'
    });
}


var load_account = () => {
    // alert();
    $(document).gmLoadPage({
        url: 'dashboard/get_account',
        load_on: '#load_page'
    });
}

$(document).ready(function () {
    load_schedule();
    load_calendar();
    //  alert();
});

$('#save_schedule').click(function () {
    $.post({
        url: 'faculty_schedule/service/Faculty_schedule_service/save_schedule',

        data: {
            faculty_id: $('#faculty_id').val(),
            subject: $('#subject').val(),
            day: $('#day').val(),
            room: $('#room').val(),
            start_time: $('#start_time').val(),
            end_time: $('#end_time').val(),
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
   
    $('#Update').click(function() {
        $.post({
             url: 'faculty_schedule/service/Faculty_schedule_service/update_schedule',
           
            data: {
                ID             : $('#ID').val(),
                faculty_id     : $('#faculty_id').val(),
                subject        : $('#subject').val(),
                day            : $('#day').val(),
                room           : $('#room').val(),
                start_time     : $('#start_time').val(),
                end_time       : $('#end_time').val(),
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
        $(document).ready(function() {
            $('.forVerif').click(function() {
                $(this).closest('tr').find('#reason').prop('disabled', false);
            });
            $('.acknowledgement').click(function() {
                $(this).closest('tr').find('#reason').prop('disabled', true);
            });
        });
        $('#confirm').click(function() {
            var radio = document.querySelectorAll('input[type="radio"]');
            var checkedData = [];
            
            radio.forEach(function(checkedRadio){
                if(checkedRadio.checked){
                    var data = {};
                    data.dataID = checkedRadio.getAttribute('data-week');
                    data.FacultyID = checkedRadio.getAttribute('data-FacID');
                    if (checkedRadio.classList.contains('acknowledgement')) {
                        data.Acknowledge = checkedRadio.value;
                        // acknowledgeReason = checkedRadio.parentElement.nextElementSibling.nextElementSibling.querySelector('input[type="text"]').value;
                    } else if (checkedRadio.classList.contains('forVerif')) {
                        data.ForVerif = checkedRadio.value;
                        data.ForVerifReason = checkedRadio.parentElement.nextElementSibling.querySelector('input[type="text"]').value;
                    }
                    checkedData.push(data);
                }
            });
            // console.log(checkedData);
            // return
            $.post('dashboard/service/Dashboard_service/insert_acknowledgement', {
                data: checkedData
            }, function(response) {
                // Handle success response
                var jsonResponse = JSON.parse(response);
                if(jsonResponse.has_error == false){
                    toastr.success(jsonResponse.message);
                } else {
                    toastr.error(jsonResponse.message); 
                }
            }).fail(function(xhr, status, error) {
                // Handle any errors that occur during the AJAX request
                var errorMessage = xhr.responseJSON ? xhr.responseJSON.message : "An error occurred.";
                toastr.error(errorMessage);
            });
        });
        
      
    function update(element){
        //alert(element.getAttribute('data-Start_time'));
        document.getElementById('ID').value=element.getAttribute('data-ID');
        document.getElementById('subject').value=element.getAttribute('data-subject');
        document.getElementById('day').value=element.getAttribute('data-day');
        document.getElementById('room').value=element.getAttribute('data-room');
        document.getElementById('start_time').value=element.getAttribute('data-start_time');
        document.getElementById('end_time').value=element.getAttribute('data-end_time');
        // console.log();
    }







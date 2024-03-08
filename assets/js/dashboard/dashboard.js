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

$('#save_schedule').click(function() {
    $.post({
         url: 'faculty_schedule/service/Faculty_schedule_service/save_schedule',
       
        data: {
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

        $('#confirm').click(function() {
            // alert($('.acknowledgement').val());
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');
            var dataId;
            var FacID;
            checkboxes.forEach(function(checkbox){
                if(checkbox.checked){
                dataId = checkbox.getAttribute('data-week');
                FacID = checkbox.getAttribute('data-FacID');
                console.log(dataId+' '+ $('.acknowledgement').val()+' '+ FacID);
            }
            });
            $.post({
                 url: 'dashboard/service/Dashboard_service/insert_acknowledgement',
                data: {
                    dataID             : dataId,
                    FacultyID              : FacID,
                    Acknowledge        : $('.acknowledgement').val()
                },
        
            })
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




    

    
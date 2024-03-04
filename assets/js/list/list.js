// var load_list = () => {
//     $(document).gmLoadPage({
//        url: 'create_document/get_documents',
//        load_on: '#load_inventory'
//    });
//  }

//  var load_user = () => {
//   $(document).gmLoadPage({
//      url: 'management/load_user',
//      load_on: '#load_user'
//  });
// }

// var load_category = () => {
//   $(document).gmLoadPage({
//      url: 'create_document/load_category',
//      load_on: '#load_user'
//  });
// }

var load_user = () => {
  $(document).gmLoadPage({
     url: 'create_user/load_user',
     load_on: '#load_user'
 });
}


// //DROPDOWN MENU LOAD TABLE

// var load_doc_list = () => {
//   $(document).gmLoadPage({
//      url: baseUrl + 'create_document/get_documents',
//      load_on: '#load_inventory'
//  });
// }

// var load_cat = () => {
//   $(document).gmLoadPage({
//      url: baseUrl + 'create_document/get_category',
//      load_on: '#load_inventory'
//  });
// }

// $(document).on('change', '#select', function () {
//     if ($('#select').val()=="Current_Documents") {
//         load_doc_list();
//     } else if ($('#select').val()=="Manage_Category"){

//         load_cat();
//     }
// }); 


 
 $(document).ready(function () {
   load_user();
});

// SAVE CUSTOMER DETAILS
$('#save_list').click(function() {
  $.post({
      url: 'management/service/Management_service/save_list',
      // selector: '.form-control',
      data: {
          List_name     : $('#List').val(),
          List_category : $('#Category').val(),
      },
      success:function(e)
          {
              var e = JSON.parse(e);
              if(e.has_error == false){
                  $('#modal-default').modal('hide');
                  toastr.success(e.message);
                  load_list();
                  setTimeout(function(){
                    window.location.reload();
                },2000); 

              } else {
                $('#List').attr('class', 'form-control inpt is-invalid');
                $('#modal-default').modal('hide');
                toastr.error(e.message); 
              }
      },
  })
});

// SAVE DOCUMENT DETAILS
$(document).on('click', '#save_doc', function() { 

  $.ajax({
      url: 'create_user/service/Create_user_service/save',
      // selector: '.form-control',
      type: 'POST',
      data: {
        fname             : $('#fname').val(),
        lname             : $('#lname').val(),
        mname             : $('#mname').val(),
        Department        : $('#Department').val(),
        Rank              : $('#Rank').val(),
        Sex               : $('#Sex').val(),
        Faculty_number    : $('#Faculty_number').val(),
        Username          : $('#Username').val(),
        User_type         : $('#User_type').val(),
        Address           : $('#Address').val(),
        Contact_Number    : $('#Contact_Number').val(),
        Estatus           : $('#Estatus').val(),
        Age               : $('#Age').val(),
        Pics              : $('#Pics').val(),
        Suffix            : $('#Suffix').val(),
        

    },

      success:function(e)
          {
              var e = JSON.parse(e);
              if(e.has_error == false){
                  $('#modal-default').modal('hide');
                  toastr.success(e.message);
                  load_user();
                //   setTimeout(function(){
                //     window.location.reload();
                // },2000); 

              } else {
                $('#doc_name').attr('class', 'form-control inpt is-invalid');
                $('#description').attr('class', 'form-control inpt is-invalid');
                $('#remarks').attr('class', 'form-control inpt is-invalid');
                $('#modal-default').modal('hide');
                toastr.error(e.message); 
              }
      },
  })
});

$(document).on('click', '#save_cat', function() { 
  //alert($('#doc_cat').val());
  //alert($('#doc_name').val);
  $.post({
      url: 'create_document/service/Create_document_service/save_cat',
      // selector: '.form-control',
      data: {
          Cat_name       : $('#doc_cat').val()
      },
      success:function(e)
          {
              var e = JSON.parse(e);
              if(e.has_error == false){
                  $('#modal-default').modal('hide');
                  toastr.success(e.message);
                  load_user();
                  setTimeout(function(){
                    window.location.reload();
                },2000); 

              } else {
                $('#doc_cat').attr('class', 'form-control inpt is-invalid');
                $('#modal-default').modal('hide');
                toastr.error(e.message); 
              }
      },
  })
});



var editFunction = (x) => {
  $.post({
    url: 'management/get_user_details',
    // selector: '.form-control',
    data: {
        user_id : x,
    },
    success:function(e)
        {
            var e = JSON.parse(e);
            $('#LName').val(e.LName);
            $('#FName').val(e.FName);
            $('#UName').val(e.Username);
            $('#Role').val(e.Role);
            $('#Branch').val(e.Branch);
            $('#Update').val(e.U_ID);
            $('#delete_user').val(e.U_ID);
            $('#reset_pass').val(e.U_ID);
            
            $('#Save').css('display','none');
            $('#Update').css('display','inline');
            $('#Reset').css('display','inline');
            $('#Delete').css('display','inline');
    },
  })
}

var editFunctionList = (x) => {
  $.post({
    url: 'management/get_list_details',
    // selector: '.form-control',
    data: {
        list_id : x,
    },
    success:function(e)
        {
            var e = JSON.parse(e);
            $('#List').val(e.List_name);
            $('#Category').val(e.List_category);

            // var x = document.getElementById("List").disabled = true;
            // var y = document.getElementById("Category").disabled = true;
            $('#delete_list').val(e.ID);
            $('#Update_list').val(e.ID);
            
            $('#Save').css('display','none');
            $('#Delete').css('display','inline');
            $('#Update_list').css('display','inline');
    },
  })
}

$('#Update').click(function() {
  $.post({
      url: 'service/Management_service/update_user',
      // selector: '.form-control',
      data: {
          U_ID: $(this).val(),
          FName     : $('#FName').val(),
          LName     : $('#LName').val(),
          Username     : $('#UName').val(),
          Branch     : $('#Branch').val(),
          Role     : $('#Role').find(':selected').data('id'),
          Role_name     : $('#Role').find(':selected').data('role')
          
      },
      success:function(e)
          {
              var e = JSON.parse(e);
              if(e.has_error == false){
                  $('#modal-default').modal('hide');
                  toastr.success(e.message);
                  load_user();
                  setTimeout(function(){
                    window.location.reload();
                },2000); 

              } else {
                $('#LName').attr('class', 'form-control inpt is-invalid');
                $('#FName').attr('class', 'form-control inpt is-invalid');
                $('#UName').attr('class', 'form-control inpt is-invalid');
                $('#modal-default').modal('hide');
                toastr.error(e.message); 
              }
      },
  })
});

$('#delete_user').click(function() {
  $.post({
      url: 'service/Management_service/delete_user',
      // selector: '.form-control',
      data: {
          U_ID: $(this).val(),
          
      },
      success:function(e)
          {
          var e = JSON.parse(e);
          if(e.has_error == false){
              $('#modal-default').modal('hide');
              toastr.success(e.message);
              load_user();
              setTimeout(function(){
                window.location.reload();
            },2000); 

          } 
      },
  })
});

$('#delete_list').click(function() {
  $.post({
      url: 'management/service/Management_service/delete_list',
      // selector: '.form-control',
      data: {
          ID: $(this).val(),
          
      },
      success:function(e)
          {
          var e = JSON.parse(e);
          if(e.has_error == false){
              $('#modal-default').modal('hide');
              toastr.success(e.message);
              load_list();
              setTimeout(function(){
                window.location.reload();
            },2000); 

          } 
      },
  })
});

$('#Update_list').click(function() {
  $.post({
      url: 'management/service/Management_service/update_list',
      // selector: '.form-control',
      data: {
          ID: $(this).val(),
          List: $('#List').val(),
          Category: $('#Category').val()
          
      },
      success:function(e)
          {
          var e = JSON.parse(e);
          if(e.has_error == false){
              // $('#modal-default').modal('hide');
              toastr.success(e.message);
              load_list();
              setTimeout(function(){
                window.location.reload();
            },2000); 

          } 
      },
  })
});

$('#reset_pass').click(function() {
  $.post({
      url: 'service/Management_service/reset',
      // selector: '.form-control',
      data: {
          U_ID: $(this).val(),
      },
      success:function(e)
          {
              var e = JSON.parse(e);
              if(e.has_error == false){
                  $('#modal-default').modal('hide');
                  toastr.success(e.message);
                  load_user();
                  setTimeout(function(){
                    window.location.reload();
                },2000); 

              } else {
                $('#LName').attr('class', 'form-control inpt is-invalid');
                $('#FName').attr('class', 'form-control inpt is-invalid');
                $('#UName').attr('class', 'form-control inpt is-invalid');
                $('#modal-default').modal('hide');
                toastr.error(e.message); 
              }
      },
  })
});
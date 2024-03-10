

var load_departments = () => {
  $(document).gmLoadPage({
    url: 'create_user/load_departments',
    load_on: '#load_departments'
  });
}


$(document).ready(function () {
  load_departments();
});

$(document).on('click', '#save_doc', function () {

  $.ajax({
    url: 'create_user/service/Create_user_service/save',
    // selector: '.form-control',
    type: 'POST',
    data: {
      fname: $('#fname').val(),
      lname: $('#lname').val(),
      mname: $('#mname').val(),
      Department: $('#Department').val(),
      Rank: $('#Rank').val(),
      Sex: $('#Sex').val(),
      Faculty_number: $('#Faculty_number').val(),
      Username: $('#Username').val(),
      User_type: $('#User_type').val(),
      Address: $('#Address').val(),
      Contact_Number: $('#Contact_Number').val(),
      Estatus: $('#Estatus').val(),
      Age: $('#Age').val(),
      Suffix: $('#Suffix').val(),
    },

    success: function (e) {
      var e = JSON.parse(e);
      if (e.has_error == false) {
        $('#modal-default').modal('hide');
        toastr.success(e.message);
        load_user();

      } else {
        $('#modal-default').modal('hide');
        toastr.error(e.message);
      }
    },
  })

});

$(document).on('click', '#add_department', function () {
  $.ajax({
    url: baseUrl + 'create_user/service/Create_user_service/add_department',
    type: 'POST',
    data: {
      dept_name: $('#dept_name').val(),
      status: $('#dept_status').val(),
    },

    success: function (e) {
      var e = JSON.parse(e);
      if (e.has_error == false) {
        $('#modal-default').modal('hide');
        toastr.success(e.message);

      } else {
        $('#modal-default').modal('hide');
        toastr.error(e.message);
      }
    },
  })
});



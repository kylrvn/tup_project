

var load_users = () => {
  $(document).gmLoadPage({
    url: 'create_user/load_users',
    load_on: '#load_users'
  });
}


$(document).ready(function () {
  load_users();
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
        load_users();
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

var loaded_user_ID = null;
function click_user(element) {

  loaded_user_ID = element.getAttribute('data-ID');

  document.getElementById('lname').value = element.getAttribute('data-Lname');
  document.getElementById('fname').value = element.getAttribute('data-Fname');
  document.getElementById('mname').value = element.getAttribute('data-Mname');
  document.getElementById('Suffix').value = element.getAttribute('data-Suffix');
  document.getElementById('Address').value = element.getAttribute('data-Address');
  document.getElementById('Contact_Number').value = element.getAttribute('data-Contact_Number');
  document.getElementById('Sex').selectedIndex = element.getAttribute('data-Sex') == "Male" ? 1 : 2;
  document.getElementById('Age').value = element.getAttribute('data-Age');
  document.getElementById('Estatus').selectedIndex = element.getAttribute('data-Estatus') == "Single" ? 1 : 2;
  document.getElementById('Faculty_number').value = element.getAttribute('data-Faculty_number');
  document.getElementById('Department').selectedIndex = element.getAttribute('data-Department') - 1;
  document.getElementById('Rank').value = element.getAttribute('data-Rank');
  document.getElementById('User_type').value = element.getAttribute('data-User_type');
  document.getElementById('Username').value = element.getAttribute('data-Username');

  document.getElementById('password_container').innerHTML = `<button class="btn btn-warning" id="reset_password" style="display:block">Reset Password</button>`;
  document.getElementById('Save').setAttribute('hidden', true);

  document.getElementById('Update').removeAttribute('hidden');
}

$(document).on('click', '#Update', function () {

  // alert($('#Department').val());
  // return;

  $.ajax({
    url: 'create_user/service/Create_user_service/update',
    type: 'POST',
    data: {
      ID: loaded_user_ID,
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
        load_users();
      } else {
        $('#modal-default').modal('hide');
        toastr.error(e.message);
      }
    },
  })
});




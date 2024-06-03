

var load_users = () => {
  $(document).gmLoadPage({
    url: 'create_user/load_users',
    load_on: '#load_users'
  });
}

var load_departments = () => {
  $(document).gmLoadPage({
    url: 'departments/load_departments',
    load_on: '#load_departments'
  });
}


$(document).ready(function () {
  load_users();
  load_departments();
});

$("#lname").on("input", function () {
  var l = $(this).val();
  var f = $('#lname').val();
  var uname = generate_username(f, l);
  $("#Username").val(uname);

});

$("#fname").on("input", function () {
  var f = $(this).val();
  var l = $('#lname').val();
  var uname = generate_username(f, l);
  $("#Username").val(uname);
});


function generate_username(f, l) {
  var string = "";
  var x = Array.from(f)[0].toUpperCase();
  //  + Array.from(f)[1];
  var y = l.charAt(0).toUpperCase() + l.slice(1);
  string = x + y;
  //  + Math.floor(Math.random() * 100);
  return string;
}

$(document).on('click', '#save_doc', function () {

  if($('#fname').val() == "" || $('#lname').val() == "" || $('#mname').val() == ""){
    toastr.error("Last Name, First Name or Middle Name is Blank, PLease check");
    return;
  }
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
    url: baseUrl + 'departments/service/Departments_service/add_department',
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
  document.getElementById('Faculty_number').value = element.getAttribute('data-Faculty_number');
  document.getElementById('Department').selectedIndex = element.getAttribute('data-Department') - 1;
  document.getElementById('Rank').value = element.getAttribute('data-Rank');
  document.getElementById('User_type').selectedIndex = element.getAttribute('data-User_type');
  document.getElementById('Username').value = element.getAttribute('data-Username');

  document.getElementById('password_container').innerHTML = `<button class="btn btn-warning" data-userID="` + loaded_user_ID + `" onclick="reset_password(this)" style="display:block">Reset Password</button>`;
  document.getElementById('Save').setAttribute('hidden', true);

  document.getElementById('Update').removeAttribute('hidden');
}

function click_department(element) {
  // alert(element.getAttribute('data-department') + ' ' + element.getAttribute('data-ID') + ' ' + element.getAttribute('data-status'));

  document.getElementById('department_id').value = element.getAttribute('data-id');
  document.getElementById('dept_name').value = element.getAttribute('data-department');
  document.getElementById('dept_status').selectedIndex = element.getAttribute('data-status') == "Active" ? 1 : 2;

  document.getElementById('add_department').setAttribute('hidden', true);
  document.getElementById('update_department').removeAttribute('hidden');
}

$(document).on('click', '#update_department', function () {
  $.ajax({
    url: 'departments/service/Departments_service/update_department',
    type: 'POST',
    data: {
      ID: $('#department_id').val(),
      department_name: $('#dept_name').val(),
      department_status: $('#dept_status').val(),
    },

    success: function (e) {
      var e = JSON.parse(e);
      if (e.has_error == false) {
        toastr.success(e.message);

        document.getElementById('update_department').setAttribute('hidden', true);
        document.getElementById('add_department').removeAttribute('hidden');
        document.getElementById('dept_name').value = "";
        document.getElementById('dept_status').selectedIndex = 0;

        load_departments();
      } else {
        toastr.error(e.message);
      }
    },
  })
});

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

function update_actives(elements) {
  $.ajax({
    url: baseUrl + 'update_actives/update_actives_data',
    type: 'POST',
    data: {
      active_term: $('#active_term1').val(),
      active_school_year: $('#active_school_year1').val()
    },
    success: function (data) {
      console.log(data);
      e = JSON.parse(data);
      if (e.has_error == false) {
        toastr.success(e.message);
        setTimeout(function () {
          window.location.reload();
        }, 2000);
      } else {
        toastr.error(e.message);
      }
    },
  });
}

function reset_password(element) {
  // alert(element.getAttribute('data-userID'));
  $.ajax({
    url: 'create_user/service/Create_user_service/reset_password',
    type: 'POST',
    data: {
      userID: element.getAttribute('data-userID'),
    },

    success: function (e) {
      var e = JSON.parse(e);
      if (e.has_error == false) {
        toastr.success(e.message);
      } else {
        toastr.error(e.message);
      }
    },
  })
}




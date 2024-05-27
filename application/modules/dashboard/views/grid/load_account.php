<?php
main_header(['Dashboard']);
?>
<!DOCTYPE html>
<html lang="en">
<head>  
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Registration Page</title>

  
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="#"><b>Update Profile</b></a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Edit user details</p>

      <form>
        <div class="input-group mb-3">
          <input type="text" id="fname" class="form-control" value="<?=@$details->Fname?>" placeholder="First Name">
          <div class="input-group-append">
            <div class="input-group-text">
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" id="lname" class="form-control" value="<?=@$details->Lname?>" placeholder="Last Name">
          <div class="input-group-append">
            <div class="input-group-text">
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" id="mname" class="form-control" value="<?=@$details->Mname?>" placeholder="Middle Name">
          <div class="input-group-append">
            <div class="input-group-text">
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" id="suffix" class="form-control" value="<?=@$details->Suffix?>" placeholder="Suffix">
          <div class="input-group-append">
            <div class="input-group-text">
            </div>
          </div>
        </div>
        <!-- <div class="input-group mb-3">
          <input type="text" id="age" class="form-control" value="<?=@$details->Age?>" placeholder="Age">
          <div class="input-group-append">
            <div class="input-group-text">
            </div>
          </div>
        </div> -->
        <!-- <div class="input-group mb-3">
          <input type="text" id="address" class="form-control" value="<?=@$details->Address?>" placeholder="Address">
          <div class="input-group-append">
            <div class="input-group-text">
            </div>
          </div>
        </div> -->
        <!-- <div class="input-group mb-3">
          <input type="text" id="conNo" class="form-control" value="<?=@$details->Contact_Number?>" placeholder="Contact Number">
          <div class="input-group-append">
            <div class="input-group-text">
            </div>
          </div>
        </div> -->
        <div class="input-group mb-3">
        <input type="text" id="eType" class="form-control" 
       value="<?= 
       (@$details->User_type == 1) ? 'Faculty (Full-Time)' : 
       ((@$details->User_type == 2) ? 'Program Head' : 
       ((@$details->User_type == 3) ? 'HR Officer' : 
       ((@$details->User_type == 4) ? 'Faculty (Part-Time)' : ''))) ?>"  
       placeholder="Employee Type">


          <div class="input-group-append">
            <div class="input-group-text">
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" id="department" class="form-control" value="<?=@$details->department_name?>" placeholder="Department">
          <div class="input-group-append">
            <div class="input-group-text">
            </div>
          </div>
        </div>
        <!-- <div class="input-group mb-3">
          <input type="text" id="eStatus" class="form-control" value="<?=@$details->Estatus?>" placeholder="Employee Status">
          <div class="input-group-append">
            <div class="input-group-text">
            </div>
          </div>
        </div> -->
        <div class="input-group mb-3">
          <input type="text" id="position" class="form-control" value="<?=@$details->rankName?>" placeholder="Position">
          <div class="input-group-append">
            <div class="input-group-text">
    
            </div>
          </div>
        </div>
        <!-- <div class="input-group mb-3">
          <input type="text" id="pics" class="form-control" value="<?=@$details->Pics?>" placeholder="Pics">
          <div class="input-group-append">
            <div class="input-group-text">
            </div>
          </div>
        </div> -->
        <!-- <div class="input-group mb-3">
          <input type="email" id="email" class="form-control" value="<?=@$details->Email?>"  placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div> -->
        <!-- <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Retype Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div> -->
        
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <!-- <input type="checkbox" id="agreeTerms" name="terms" value="agree">
              <label for="agreeTerms">
               I agree to the <a href="#">terms</a>
              </label> -->
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" id="update_user_info" class="btn btn-primary btn-block" style="background-color:#9F3A3B;">UPDATE</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

     

    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->


</body>

</html>
<?php
main_footer();
?>
    <script src="<?php echo base_url() ?>/assets/js/user/user.js"></script>
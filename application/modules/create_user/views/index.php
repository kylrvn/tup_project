<?php
main_header(['Create_User']);

// var_dump($departments);
?>
<!-- ############ PAGE START-->
<style>
</style>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Manage Users</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <div class="input-group"
                        style="width:250px; position: absolute; right:0px; top:0px; margin-right:12px;">
                    </div>

                    <!-- <li class="breadcrumb-item active">Management</li> -->
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="row">
            <div class="col-7">
                <div class="card card-default">
                    <div class="card-header" style="background-color:#9F3A3B; color: white;">
                        <h3 class="card-title">User Details</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" id="lname" class="form-control inpt" placeholder="Last Name">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text" id="fname" class="form-control inpt" placeholder="First Name">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Middle Name</label>
                                    <input type="text" id="mname" class="form-control inpt" placeholder="Middle Name">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Suffix</label>
                                    <input type="text" id="Suffix" class="form-control inpt" placeholder="Suffix">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label for="">Address</label>
                                    <input type="text" id="Address" class="form-control inpt" placeholder="Address">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Contact Number</label>
                                    <input type="number" id="Contact_Number" class="form-control inpt"
                                        placeholder="Contact Number">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Sex</label>
                                    <select id="Sex" class="form-control inpt" placeholder="Sex">
                                        <option value="" selected disabled>Select</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Age</label>
                                    <input type="number" id="Age" class="form-control inpt" placeholder="Age">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Civil Status</label>
                                    <select id="Estatus" class="form-control inpt" placeholder="Sex">
                                        <option value="" selected disabled>Select Status</option>
                                        <option value="Single">Single</option>
                                        <option value="Married">Married</option>
                                        <!-- <option value="Widowed">Widowed</option> -->
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Faculty Number</label>
                                    <input type="text" id="Faculty_number" class="form-control inpt"
                                        placeholder="Faculty Number">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Department</label>
                                    <select type="text" id="Department" class="form-control inpt"
                                        placeholder="Department">
                                        <?php
                                        foreach ($departments as $key => $dept) { ?>
                                        <option value="<?= $dept->ID ?>">
                                            <?= $dept->department_name ?>
                                        </option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Position</label>
                                    <input type="text" id="Rank" class="form-control inpt" placeholder="Position">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">User Type</label>
                                    <select type="text" id="User_type" class="form-control inpt"
                                        placeholder="User_type">
                                        <option value="1">Faculty</option>
                                        <option value="2">Program Head</option>
                                        <option value="3">HR Officer</option>
                                        <option value="4">Admin</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Username</label>
                                    <input type="text" id="Username" class="form-control inpt" placeholder="Username">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="">Password</label>
                                        <cont id="password_container">
                                            <input type="text" disabled id="Username" class="form-control inpt"
                                                placeholder="Default Password is 123456">
                                        </cont>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default"
                            id="Save">Create User</button>

                        <button type="button" class="btn btn-primary" hidden id="Update">Update User</button>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer" style="background-color:#9F3A3B; color: white;">
                        <!-- Footer Details Here -->
                    </div>
                </div>
            </div>
            <div class="col-5">
                <div class="card card-default">
                    <div class="card-header" style="background-color:#9F3A3B; color: white;">
                        <h3 class="card-title">Current Users</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body" style="font-size:90%;">
                        <table class="table border-in-table table-hover table-sm">
                            <thead>
                                <tr>
                                    <th>FACULTY #</th>
                                    <th>USER NAME</th>
                                    <th>USER TYPE</th>
                                    <th>DEPARTMENT</th>
                                </tr>
                            </thead>
                            <tbody id="load_users">
                                <!-- Content Here loaded via JS -->
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer" style="background-color:#9F3A3B; color: white;">
                        <!-- Footer Details Here -->
                    </div>
                </div>
            </div>
        </div>
</section>

<!-- CONFIRMATION MODAL SAVE -->
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Are you sure you want to save details?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="save_doc" data-samplefile="">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL FOR ADD CATEGORY-->
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Are you sure you want to add category?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="save_doc">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- ############ PAGE END-->
<?php
main_footer();
?>
<script src="<?php echo base_url() ?>/assets/js/list/list.js"></script>
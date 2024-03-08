<?php
main_header(['Create_User']);
// var_dump($category);
?>
<!-- ############ PAGE START-->
<style>
</style>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Create User</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <div class="input-group"
                        style="width:250px; position: absolute; right:0px; top:0px; margin-right:12px;">
                        <select class="form-control" id="select">
                            <option value="Current_Documents">Current Documents</option>
                            <option value="Manage_Category">Manage Category</option>
                            <!-- <option value="Ordering"> Ordering </option> -->
                        </select>
                    </div>

                    <!-- <li class="breadcrumb-item active">Management</li> -->
                </ol>
            </div>
        </div>
    </div>
</div>


<!-- <section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card card-primary" >
                    <div class="card-header" style="background-color:#9F3A3B;">
                        <h3 class="card-title">User Account</h3>
                    </div>
                    <form id="uploadForm" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="row">
                            <div class="form-group w-100">
                                    <label for="">Faculty Number</label>
                                    <input type="text" id="Faculty_number" class="form-control inpt" placeholder="Faculty Number">
                                <div class="form-group w-100">
                                    <label for="">First Name</label>
                                    <input type="text" id="fname" class="form-control inpt" placeholder="First Name">
                                </div>
                                <div class="form-group w-100">
                                    <label for="">Last Name</label>
                                    <input type="text" id="lname" class="form-control inpt" placeholder="Last Name">
                                </div>
                                <div class="form-group w-100">
                                    <label for="">Middle Name</label>
                                    <input type="text" id="mname" class="form-control inpt" placeholder="Middle Name">
                                </div>
                                <div class="form-group w-100">
                                    <label for="">Suffix</label>
                                    <input type="text" id="Suffix" class="form-control inpt" placeholder="Suffix">
                                </div>
            
                                <div class="form-group w-100">
                                    <label for="">Sex</label>
                                    <select type="text" id="Sex" class="form-control inpt" placeholder="Sex">
                                        <option value = "Male">Male</option>
                                        <option value = "Female">Female</option>                       
                                    </select>
                                </div>
                                <div class="form-group w-100">
                                    <label for="">Age</label>
                                    <input type="text" id="Age" class="form-control inpt" placeholder="Age">
                                    </div>
                        
                                <div class="form-group w-100">
                                    <label for="">Address</label>
                                    <input type="text" id="Address" class="form-control inpt" placeholder="Address">
                                </div>

                                <div class="form-group w-100">
                                    <label for="">Contact Number</label>
                                    <input type="text" id="Contact_Number" class="form-control inpt" placeholder="Contact Number">
                                </div>
                                
                                
                                <div class="form-group w-100">
                                    <label for="">Department</label>
                                    <select type="text" id="Department" class="form-control inpt" placeholder="Department">
                                        <option value = "ECE">ECE </option>
                                        <option value = "ME">ME </option>
                                        <option value = "BSET">BSET </option>
                                    </select>
                               
                                </div>
                               
                                <div class="form-group w-100">
                                    <label for="">Status</label>
                                    <input type="text" id="Estatus" class="form-control inpt" placeholder="Status">
                                    
                                </div>
                                <div class="form-group w-100">
                                    <label for="">Rank</label>
                                    <input type="text" id="Rank" class="form-control inpt" placeholder="Rank">
                                    </div>
                               
                                <div class="form-group w-100">
                                    <label for="">Pics</label>
                                    <input type="text" id="Pics" class="form-control inpt" placeholder="Pics">
                                </div>

                                <div class="form-group w-100">
                                    <label for="">Username</label>
                                    <input type="text" id="Username" class="form-control inpt" placeholder="Username">
                                </div>
                                
                                <div class="form-group w-100">
                                    <label for="">User Type</label>
                                    <select type="text" id="User_type" class="form-control inpt" placeholder="User_type">
                                        <option value = "Administrator">Administrator</option>
                                        <option value = "User">User</option>
                                    </select>
                                </div>
                                
                        <div class="card-footer">
                            <button type="button" class="btn btn-primary" style="background-color:#9F3A3B;" data-toggle="modal" data-target="#modal-default" id="Save">Submit</button>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-list" style="display: none" id="Delete">Delete</button>
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-list2" id="Update_list">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section> -->

<section class="content">
    <div class="row">
        <div class="col-lg-3">
            <div class="card card-primary">
                <div class="card-header" style="background-color:#9F3A3B;">
                    <h3 class="card-title">User Account</h3>
                </div>
                <form id="uploadForm" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group w-100">
                                <label for="">Faculty Number</label>
                                <input type="text" id="Faculty_number" class="form-control inpt"
                                    placeholder="Faculty Number">
                                <div class="form-group w-100">
                                    <label for="">First Name</label>
                                    <input type="text" id="fname" class="form-control inpt" placeholder="First Name">
                                </div>
                                <div class="form-group w-100">
                                    <label for="">Last Name</label>
                                    <input type="text" id="lname" class="form-control inpt" placeholder="Last Name">
                                </div>
                                <div class="form-group w-100">
                                    <label for="">Middle Name</label>
                                    <input type="text" id="mname" class="form-control inpt" placeholder="Middle Name">
                                </div>
                                <div class="form-group w-100">
                                    <label for="">Suffix</label>
                                    <input type="text" id="Suffix" class="form-control inpt" placeholder="Suffix">
                                </div>

                                <div class="form-group w-100">
                                    <label for="">Sex</label>
                                    <select type="text" id="Sex" class="form-control inpt" placeholder="Sex">
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div class="form-group w-100">
                                    <label for="">Age</label>
                                    <input type="text" id="Age" class="form-control inpt" placeholder="Age">
                                </div>

                                <div class="form-group w-100">
                                    <label for="">Address</label>
                                    <input type="text" id="Address" class="form-control inpt" placeholder="Address">
                                </div>

                                <div class="form-group w-100">
                                    <label for="">Contact Number</label>
                                    <input type="text" id="Contact_Number" class="form-control inpt"
                                        placeholder="Contact Number">
                                </div>


                                <div class="form-group w-100">
                                    <label for="">Department</label>
                                    <select type="text" id="Department" class="form-control inpt"
                                        placeholder="Department">
                                        <option value="ECE">ECE </option>
                                        <option value="ME">ME </option>
                                        <option value="BSET">BSET </option>
                                    </select>

                                </div>

                                <div class="form-group w-100">
                                    <label for="">Status</label>
                                    <input type="text" id="Estatus" class="form-control inpt" placeholder="Status">

                                </div>
                                <div class="form-group w-100">
                                    <label for="">Rank</label>
                                    <input type="text" id="Rank" class="form-control inpt" placeholder="Rank">
                                </div>

                                <div class="form-group w-100">
                                    <label for="">Pics</label>
                                    <input type="text" id="Pics" class="form-control inpt" placeholder="Pics">
                                </div>

                                <div class="form-group w-100">
                                    <label for="">Username</label>
                                    <input type="text" id="Username" class="form-control inpt" placeholder="Username">
                                </div>

                                <div class="form-group w-100">
                                    <label for="">User Type</label>
                                    <select type="text" id="User_type" class="form-control inpt"
                                        placeholder="User_type">
                                        <option value="Administrator">Administrator</option>
                                        <option value="User">User</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="button" class="btn btn-primary" style="background-color:#9F3A3B;"
                            data-toggle="modal" data-target="#modal-default" id="Save">Submit</button>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-list"
                            style="display: none" id="Delete">Delete</button>
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-list2"
                            id="Update_list">Update</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-9">
            <table class="table border-in-table table-hover table-sm">
                <thead>
                    <tr>
                        <th style="width: 5%;">#</th>
                        <th style="width: 20%;">FACULTY ID</th>
                        <th style="width: 25%;">NAME</th>
                        <th style="width: 15%;">DEPARTMENT</th>

                    </tr>
                </thead>
                <h5>Schedule</h5>
                <div class="input-group"
                    style="width:250px; position: absolute; right:0px; top:0px; margin-right:12px;">
                    <input type="text" class="form-control form-control-sm" id="search_text" data-field="Search"
                        placeholder="Search Account name">
                    <span class="input-group-btn">
                        <button class="btn btn-sm btn-success" id="search" type="button"><i
                                class="fa fa-search"></i></button>
                    </span>
                </div>
                <tbody id="load_user"></tbody>
            </table>
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
            <!-- <div class="modal-body">
                <p>One fine body&hellip;</p>
            </div> -->
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
            <!-- <div class="modal-body">
                <p>One fine body&hellip;</p>
            </div> -->
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="save_doc">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- CONFIRMATION MODAL DELETE -->
<div class="modal fade" id="modal-list">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Are you sure you want to delete list?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- <div class="modal-body">
                <p>One fine body&hellip;</p>
            </div> -->
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="delete_list">Yes</button>
            </div>
        </div>
    </div>
</div>

<!-- ############ PAGE END-->
<?php
main_footer();
?>
<script src="<?php echo base_url() ?>/assets/js/list/list.js"></script>
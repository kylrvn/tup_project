<?php
main_header(['Faculty_schedule']);
// var_dump($category);
?>
<!-- ############ PAGE START-->
<style>
</style>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Faculty schedule</h1>
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


<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- <div class="col-sm-3">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Faculty schedule</h3>
                    </div>
                    <form id="uploadForm" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="row">
                            <div class="form-group w-100">
                                    <label for="">Faculty ID</label>
                                    <input type="text" id="faculty_id" class="form-control inpt" placeholder="Faculty ID">
                                </div>
                                <div class="form-group w-100">
                                    <label for="">Subject</label>
                                    <input type="text" id="subject" class="form-control inpt" placeholder="Subject">
                                </div>
                                <div class="form-group w-100">
                                    <label for="">Day</label>                            
                                    <select name="Day" id="day" class="form-control form-control-sm">
                                        <option value="monday">Monday</option>
                                        <option value="tuesday">Tuesday</option>
                                        <option value="wednesday">Wednesday</option>
                                        <option value="thursday">Thursday</option>
                                        <option value="friday">Friday</option>
                                        <option value="saturday">Saturday</option>
                                    </select>         
                                </div>
                                <div class="form-group w-100">
                                    <label for="">Room</label>
                                    <input type="text" id="room" class="form-control inpt" placeholder="Room">
                                </div>
                                <div class="form-group w-100">
                                    <label for="">Start Time</label>
                                    <input type="time" id="start_time" class="form-control inpt" placeholder="Start Time">
                                </div>
                                <div class="form-group w-100">
                                    <label for="">End Time</label>
                                    <input type="time" id="end_time" class="form-control inpt" placeholder="End Time">
                                </div>
                                
                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default" id="Save">Submit</button>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-list" style="display: none" id="Delete">Delete</button>
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-list2" style="display: none" id="Update_list">Update</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-sm-5">
                <table class="table border-in-table table-hover table-sm">   
                    <thead>                            
                        <tr >			
                            <th style="width: 5%;">#</th> 
                            <th style="width: 15%;">FACULTY ID</th>
                            <th style="width: 25%;">SUBJECT</th>
                            <th style="width: 15%;">ROOM</th>
                            <th style="width: 15%;">DAY</th>
                            <th style="width: 25%;">START TIME</th>
                            <th style="width: 25%;">END TIME</th>

                        </tr>
                    </thead>
                    <h5>List of Users</h5>
                    <div class="input-group" style="width:250px; position: absolute; right:0px; top:0px; margin-right:0px;">
                        <input type="text" class="form-control-sm" id="search_text" data-field="Search" placeholder="Search Account name">
                        <span class="input-group-btn">
                            <button class="btn btn-sm btn-success" id="search" type="button"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                    <tbody id="load_contacts"></tbody>
                </table>
            </div> -->

            <div class="col-sm-3">
                <div class="card card-primary">
                    <div class="card-header" style="background-color:#db7378;">
                        <h3 class="card-title">Faculty schedule</h3>
                    </div>
                    <form id="uploadForm" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="row">
                                <!-- <div class="form-group w-100">
                                        <label for="">Faculty ID</label>
                                        <input type="text" id="faculty_id" class="form-control inpt" placeholder="Faculty ID">
                                    </div> -->
                                <input type="text" id="ID" hidden class="form-control inpt" placeholder="Subject">
                                <div class="form-group w-100">
                                    <label for="">Subject</label>
                                    <input type="text" id="subject" class="form-control inpt" placeholder="Subject">
                                </div>
                                <div class="form-group w-100">
                                    <label for="">Day</label>
                                    <select name="Day" id="day" class="form-control form-control-sm">
                                        <option value="monday">Monday</option>
                                        <option value="tuesday">Tuesday</option>
                                        <option value="wednesday">Wednesday</option>
                                        <option value="thursday">Thursday</option>
                                        <option value="friday">Friday</option>
                                        <option value="saturday">Saturday</option>
                                    </select>
                                </div>
                                <div class="form-group w-100">
                                    <label for="">Room</label>
                                    <input type="text" id="room" class="form-control inpt" placeholder="Room">
                                </div>
                                <div class="form-group w-100">
                                    <label for="">Start Time</label>
                                    <input type="time" id="start_time" class="form-control inpt"
                                        placeholder="Start Time">
                                </div>
                                <div class="form-group w-100">
                                    <label for="">End Time</label>
                                    <input type="time" id="end_time" class="form-control inpt" placeholder="End Time">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#modal-default" id="Save">Submit</button>
                            <button type="button" class="btn btn-primary" hidden id="Update">Update</button>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-list"
                                style="display: none" id="Delete">Delete</button>
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-list2"
                                style="display: none" id="Update_list">Update</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-sm-9">
                <table class="table border-in-table table-hover table-sm">
                    <thead>
                        <tr>
                            <th style="width: 5%;">#</th>
                            <th style="width: 20%;">FACULTY ID</th>
                            <th style="width: 25%;">SUBJECT</th>
                            <th style="width: 15%;">ROOM</th>
                            <th style="width: 15%;">DAY</th>
                            <th style="width: 20%;">START TIME</th>
                            <th style="width: 20%;">END TIME</th>

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
                    <tbody id="load_schedule"></tbody>
                </table>
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
            <!-- <div class="modal-body">
                <p>One fine body&hellip;</p>
            </div> -->
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="save_schedule" data-samplefile="">Save</button>
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
<script src="<?php echo base_url() ?>/assets/js/schedule/schedule.js"></script>
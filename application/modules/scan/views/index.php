<?php
main_header(['Scan']);
// var_dump($category);
?>
<!-- ############ PAGE START-->
<style>
    body {
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }
</style>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Scan</h1>
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
            <div class="col-lg-3 col-md-6 col-sm-12">
                <!-- NEW CUSTOMER -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Scan</h3>
                    </div>
                    <form id="uploadForm" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group w-100">
                                    <label for="">Faculty Number</label>
                                    <input type="text" id="faculty_no" class="form-control inpt"
                                        placeholder="Faculty No.">
                                </div>

                                <!-- <div class="form-group w-100">
                                    <label for="">DateTime</label>
                                    <input type="text" id="date_time" class="form-control inpt" placeholder="DateTime"> -->
                                <!-- </div> -->
                                <!-- <div class="form-group w-100">
                                    <label for="">Middle Name</label>
                                    <input type="text" id="mname" class="form-control inpt" placeholder="Middle Name">
                                </div>
                                <div class="form-group w-100">
                                    <label for="">Department</label>
                                    <input type="text" id="Department" class="form-control inpt" placeholder="Department">
                                </div>
                                <div class="form-group w-100">
                                    <label for="">Position</label>
                                    <input type="text" id="DPosition" class="form-control inpt" placeholder="Position">
                                </div>
                                <div class="form-group w-100">
                                    <label for="">Gender</label>
                                    <input type="text" id="Gender" class="form-control inpt" placeholder="Gender">
                                </div>
                                <div class="form-group w-100">
                                    <label for="">Department</label>
                                    <input type="text" id="Department" class="form-control inpt" placeholder="Department">
                                    </div>
                                <div class="form-group w-100">
                                    <label for="">Department</label>
                                    <input type="text" id="Department" class="form-control inpt" placeholder="Department">
                                    
                                </div>
                                <div class="form-group w-100">
                                    <label for="">Publish Date</label>
                                    <input type="date" id="pub_date" class="form-control inpt">
                                </div> -->
                            </div>
                            <div class="card-footer">
                                <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default" id="Save">Submit</button> -->
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#modal-default" id="Scan">Scan</button>
                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                    data-target="#modal-list" style="display: none" id="Delete">Delete</button>
                                <button type="button" class="btn btn-warning" data-toggle="modal"
                                    data-target="#modal-list2" style="display: none" id="Update_list">Update</button>
                            </div>
                    </form>
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
            <!-- <div class="modal-body">
                <p>One fine body&hellip;</p>
            </div> -->
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="save_scan" data-samplefile="">Save</button>
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
<script src="<?php echo base_url() ?>/assets/js/scan/scan.js"></script>
<?php
main_header(['Manage_Departments']);
// var_dump($category);
?>
<!-- ############ PAGE START-->
<style>
</style>

<input hidden type="text" id="department_id" value="">

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Manage Departments</h1>
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

        <section class="content">
            <div class="row">
                <div class="col-lg-3">
                    <div class="card card-primary">
                        <div class="card-header" style="background-color:#9F3A3B;">
                            <h3 class="card-title">Department Management</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group w-100">
                                    <div class="form-group w-100">
                                        <label for="">Department Name:</label>
                                        <input type="text" id="dept_name" class="form-control"
                                            placeholder="Enter Dept. Name">
                                    </div>
                                    <div class="form-group w-100">
                                        <label for="">Department Status</label>
                                        <select id="dept_status" class="form-control" placeholder="User_type">
                                            <option value="" selected disabled>Select Status</option>
                                            <option value="Active">Active</option>
                                            <option value="In-active">In-active</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button class="btn btn-success" id="add_department">Add Department</button>
                            <button class="btn btn-primary" id="update_department" hidden>Update Department</button>
                        </div>
                    </div>
                </div>

                <!-- TABLE -->
                <div class="col-lg-6">
                    <div class="card card-primary">
                        <div class="card-header" style="background-color:#9F3A3B;">
                            <h3 class="card-title">List of Departments</h3>

                        </div>
                        <div class="card-body">
                            <table class="table border-in-table table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>DEPARTMENT NAME</th>
                                        <th>STATUS</th>
                                    </tr>
                                </thead>
                                <tbody id="load_departments">

                                </tbody>
                            </table>
                        </div>

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
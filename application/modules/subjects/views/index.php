<?php
main_header(['Manage_Subjects']);
// var_dump($category);
?>
<!-- ############ PAGE START-->
<style>
</style>

<input hidden id="subject_id" value="">

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Manage Subjects</h1>
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
                <div class="col-lg-4">
                    <div class="card card-primary">
                        <div class="card-header" style="background-color:#9F3A3B;">
                            <h3 class="card-title">Subjects Management</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group w-100">
                                    <div class="form-group w-100">
                                        <label for="">Subject Name:</label>
                                        <input type="text" id="subject_name" class="form-control"
                                            placeholder="Enter Subject Name">
                                    </div>
                                    <div class="form-group w-100">
                                        <label for="">Subject Code:</label>
                                        <input type="text" id="subject_code" class="form-control"
                                            placeholder="Enter Subject Code">
                                    </div>
                                    <div class="form-group">
                                        <label>Subject Color:</label>

                                        <div class="input-group my-colorpicker2">
                                            <input type="text" class="form-control" id="color">

                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-square"
                                                        id="color_box"></i></span>
                                            </div>
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                    <div class="form-group w-100">
                                        <label for="">Department</label>
                                        <select id="department" class="form-control" placeholder="User_type">
                                            <option value="" selected disabled>Select Department</option>
                                            <?php
                                            foreach ($departments as $key => $value) { ?>
                                                <option value="<?= $value->ID ?>">
                                                    <?= $value->department_name ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group w-100">
                                        <label for="">Subject Status</label>
                                        <select id="subject_status" class="form-control" placeholder="User_type">
                                            <option value="" selected disabled>Select Status</option>
                                            <option value="1">Active</option>
                                            <option value="0">In-active</option>
                                        </select>
                                    </div>
                                </div>
                                <button class="btn btn-success" id="add_subject">Add Subject</button>
                                <button class="btn btn-primary" hidden id="update_subject">Update
                                    Subject</button>
                            </div>
                        </div>

                        <div class="card-footer">

                        </div>
                    </div>
                </div>

                <!-- TABLE -->
                <div class="col-lg-8">
                    <div class="card card-primary">
                        <div class="card-header" style="background-color:#9F3A3B;">
                            <h3 class="card-title">List of Subjects</h3>

                        </div>
                        <div class="card-body">
                            <table class="table border-in-table table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>SUBJECT NAME</th>
                                        <th>COLOR</th>
                                        <th>DEPARTMENT</th>
                                        <th>STATUS</th>
                                    </tr>
                                </thead>
                                <tbody id="load_subjects">

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
<script src="<?php echo base_url() ?>/assets/js/subjects/subjects.js"></script>
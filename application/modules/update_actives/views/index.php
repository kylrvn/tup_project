<?php
main_header(['Manage_Actives']);
// var_dump($session->term_data);
?>
<!-- ############ PAGE START-->
<style>
</style>

<input hidden type="text" id="department_id" value="">

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Manage Actives</h1>
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
<section class="content" style="display: flex; justify-content: center; align-items: center;">
    <div class="row" style="width:60%;">
        <div class="col-12">
            <div class="pt-3 pb-3 rounded"
                style="display:<?= $session->User_type == "3" || $session->User_type == "4" ? '' : 'none' ?>; background-color:#9F3A3B;">
                <div class="row ml-2 mr-2">
                    <label style="font-size:100%; color:white;">Set Active School Year:</label>
                    <input type="text" class="form-control" name="schoolyearrange1" id="active_school_year1"
                        value="<?= $session->term_data->active_school_year ?>"
                        style="text-align:center; font-size:130%; font-weight:550;" />

                </div>
                <div class="row ml-2 mr-2">
                    <label style="font-size:100%; color:white;">Set Active Term:</label>
                    <select id="active_term1" class="form-control"
                        style="text-align:center; font-size:130%; font-weight:550;">
                        <option value="" disabled selected>Select Term</option>
                        <option value="1st" <?= $session->term_data->active_term == "1st" ? "selected" : '' ?>>1st Term
                        </option>
                        <option value="2nd" <?= $session->term_data->active_term == "2nd" ? "selected" : '' ?>>2nd Term
                        </option>
                        <option value="3rd" <?= $session->term_data->active_term == "3rd" ? "selected" : '' ?>>3rd Term
                        </option>
                    </select>
                    <button class="btn btn-success mt-4" onclick="update_actives(this)"
                        style="width:100%;">Update</button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ############ PAGE END-->
<?php
main_footer();
?>
<script src="<?php echo base_url() ?>/assets/js/list/list.js"></script>
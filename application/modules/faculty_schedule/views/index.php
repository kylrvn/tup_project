<?php
main_header(['Faculty_schedule']);
// var_dump($subjects);
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
                        <!-- <select class="form-control" id="select">
              <option value="Current_Documents">Current Documents</option>
              <option value="Manage_Category">Manage Category</option>
            </select> -->
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

            <div class="col-sm-12">
                <div class="card card-primary" style="zoom:80%;">
                    <div class="card-header" style="background-color:#9f3a3b;">
                        <h6 style="font-size: 100%;"><i class="fa fa-info"></i><b> NOTE:</b>
                            Empty rows will not be added to schedule.
                            If your subject isn't in the list, click the &nbsp; <i class="fas fa-list"></i> &nbsp;
                            button next to the drop-down and manually type you subject.
                        </h6>
                    </div>
                    <div class="card-body" style="background-color:#D16567;">
                        <table class="table" style="width: 100%; color: white;">
                            <thead>
                                <tr>
                                    <th class="text-left">DAY</th>
                                    <th class="text-left">ADD ROW</th>
                                    <th class="text-center">TIME FRAME</th>
                                    <th class="text-center">TIME</th>
                                    <th class="text-center">SUBJECT</th>
                                    <th class="text-center">ROOM</th>
                                    <th class="text-center"># OF HRS.</th>
                                </tr>
                            </thead>
                            <tbody id="table_monday">
                                <tr>
                                    <td class="text-left">
                                        <label>MONDAY</label>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-primary " data-day="monday"
                                            onclick="add_row_am(this)">AM</button>
                                        <button class="btn btn-sm btn-primary " data-day="monday"
                                            onclick="add_row_pm(this)">PM</button>
                                        <input type="text" hidden name="day" value="monday">
                                    </td>
                                    <td class="text-center">
                                        <b>AM</b>
                                    </td>
                                    <td class="text-center">
                                        <input type="text" hidden name="time_frame" value="AM">
                                        <input type="time" name="start" onchange="check_am_time(this)">
                                        TO
                                        <input type="time" name="end" onchange="check_am_time(this)">
                                        <br>
                                    </td>
                                    <td class="text-center">
                                        <div style="display: flex; align-items: center;">
                                            <select class="text-center" name="subject"
                                                style="width:88%; height:1.8rem;">
                                                <option value="" selected disabled>SELECT SUBJECT</option>
                                                <?php
                                                foreach ($subjects as $key => $data) { ?>
                                                    <option value="<?= $data->Subject_name ?>">
                                                        <?= $data->Subject_name ?>
                                                    </option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                            <button class="btn btn-sm btn-success" onclick="add_subject(this)"
                                                style="width:12%; height:1.8rem;"><i class="fas fa-list"></i></button>
                                        </div>
                                        <br>
                                    </td>

                                    <td class="text-center">
                                        <input class="text-center" type="text" name="room" style="width:60%;"
                                            placeholder="ROOM #">
                                        <br>
                                    </td>
                                    <td class="text-center">
                                        <input type="text" disabled id="total_time" style="width:20%;">
                                    </td>
                                </tr>
                            </tbody>
                            <tbody id="table_tuesday">
                                <tr>
                                    <td class="text-left">
                                        <label>TUESDAY</label>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-primary " data-day="tuesday"
                                            onclick="add_row_am(this)">AM</button>
                                        <button class="btn btn-sm btn-primary " data-day="tuesday"
                                            onclick="add_row_pm(this)">PM</button>
                                        <input type="text" hidden name="day" value="tuesday">
                                    </td>
                                    <td class="text-center">
                                        <b>AM</b>
                                    </td>
                                    <td class="text-center">
                                        <input type="text" hidden name="time_frame" value="AM">
                                        <input type="time" name="start" onchange="check_am_time(this)">
                                        TO
                                        <input type="time" name="end" onchange="check_am_time(this)">
                                        <br>
                                    </td>
                                    <td class="text-center">
                                        <div style="display: flex; align-items: center;">
                                            <select class="text-center" name="subject"
                                                style="width:88%; height:1.8rem;">
                                                <option value="" selected disabled>SELECT SUBJECT</option>
                                                <?php
                                                foreach ($subjects as $key => $data) { ?>
                                                    <option value="<?= $data->Subject_name ?>">
                                                        <?= $data->Subject_name ?>
                                                    </option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                            <button class="btn btn-sm btn-success" onclick="add_subject(this)"
                                                style="width:12%; height:1.8rem;"><i class="fas fa-list"></i></button>
                                        </div>
                                        <br>
                                    </td>
                                    <td class="text-center">
                                        <input class="text-center" type="text" name="room" style="width:60%;"
                                            placeholder="ROOM #">
                                        <br>
                                    </td>
                                    <td class="text-center">
                                        <input type="text" disabled id="total_time" style="width:20%;">
                                    </td>
                                </tr>
                            </tbody>
                            <tbody id="table_wednesday">
                                <tr>
                                    <td class="text-left">
                                        <label>WEDNESDAY</label>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-primary " data-day="wednesday"
                                            onclick="add_row_am(this)">AM</button>
                                        <button class="btn btn-sm btn-primary " data-day="wednesday"
                                            onclick="add_row_pm(this)">PM</button>
                                        <input type="text" hidden name="day" value="wednesday">
                                    </td>
                                    <td class="text-center">
                                        <b>AM</b>
                                    </td>
                                    <td class="text-center">
                                        <input type="text" hidden name="time_frame" value="AM">
                                        <input type="time" name="start" onchange="check_am_time(this)">
                                        TO
                                        <input type="time" name="end" onchange="check_am_time(this)">
                                        <br>
                                    </td>
                                    <td class="text-center">
                                        <div style="display: flex; align-items: center;">
                                            <select class="text-center" name="subject"
                                                style="width:88%; height:1.8rem;">
                                                <option value="" selected disabled>SELECT SUBJECT</option>
                                                <?php
                                                foreach ($subjects as $key => $data) { ?>
                                                    <option value="<?= $data->Subject_name ?>">
                                                        <?= $data->Subject_name ?>
                                                    </option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                            <button class="btn btn-sm btn-success" onclick="add_subject(this)"
                                                style="width:12%; height:1.8rem;"><i class="fas fa-list"></i></button>
                                        </div>
                                        <br>
                                    </td>
                                    <td class="text-center">
                                        <input class="text-center" type="text" name="room" style="width:60%;"
                                            placeholder="ROOM #">
                                        <br>
                                    </td>
                                    <td class="text-center">
                                        <input type="text" disabled id="total_time" style="width:20%;">
                                    </td>
                                </tr>
                            </tbody>
                            <tbody id="table_thursday">
                                <tr>
                                    <td class="text-left">
                                        <label>THURSDAY</label>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-primary " data-day="thursday"
                                            onclick="add_row_am(this)">AM</button>
                                        <button class="btn btn-sm btn-primary " data-day="thursday"
                                            onclick="add_row_pm(this)">PM</button>
                                        <input type="text" hidden name="day" value="thursday">
                                    </td>
                                    <td class="text-center">
                                        <b>AM</b>
                                    </td>
                                    <td class="text-center">
                                        <input type="text" hidden name="time_frame" value="AM">
                                        <input type="time" name="start" onchange="check_am_time(this)">
                                        TO
                                        <input type="time" name="end" onchange="check_am_time(this)">
                                        <br>
                                    </td>
                                    <td class="text-center">
                                        <div style="display: flex; align-items: center;">
                                            <select class="text-center" name="subject"
                                                style="width:88%; height:1.8rem;">
                                                <option value="" selected disabled>SELECT SUBJECT</option>
                                                <?php
                                                foreach ($subjects as $key => $data) { ?>
                                                    <option value="<?= $data->Subject_name ?>">
                                                        <?= $data->Subject_name ?>
                                                    </option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                            <button class="btn btn-sm btn-success" onclick="add_subject(this)"
                                                style="width:12%; height:1.8rem;"><i class="fas fa-list"></i></button>
                                        </div>
                                        <br>
                                    </td>
                                    <td class="text-center">
                                        <input class="text-center" type="text" name="room" style="width:60%;"
                                            placeholder="ROOM #">
                                        <br>
                                    </td>
                                    <td class="text-center">
                                        <input type="text" disabled id="total_time" style="width:20%;">
                                    </td>
                                </tr>
                            </tbody>
                            <tbody id="table_friday">
                                <tr>
                                    <td class="text-left">
                                        <label>FRIDAY</label>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-primary " data-day="friday"
                                            onclick="add_row_am(this)">AM</button>
                                        <button class="btn btn-sm btn-primary " data-day="friday"
                                            onclick="add_row_pm(this)">PM</button>
                                        <input type="text" hidden name="day" value="friday">
                                    </td>
                                    <td class="text-center">
                                        <b>AM</b>
                                    </td>
                                    <td class="text-center">
                                        <input type="text" hidden name="time_frame" value="AM">
                                        <input type="time" name="start" onchange="check_am_time(this)">
                                        TO
                                        <input type="time" name="end" onchange="check_am_time(this)">
                                        <br>
                                    </td>
                                    <td class="text-center">
                                        <div style="display: flex; align-items: center;">
                                            <select class="text-center" name="subject"
                                                style="width:88%; height:1.8rem;">
                                                <option value="" selected disabled>SELECT SUBJECT</option>
                                                <?php
                                                foreach ($subjects as $key => $data) { ?>
                                                    <option value="<?= $data->Subject_name ?>">
                                                        <?= $data->Subject_name ?>
                                                    </option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                            <button class="btn btn-sm btn-success" onclick="add_subject(this)"
                                                style="width:12%; height:1.8rem;"><i class="fas fa-list"></i></button>
                                        </div>
                                        <br>
                                    </td>
                                    <td class="text-center">
                                        <input class="text-center" type="text" name="room" style="width:60%;"
                                            placeholder="ROOM #">
                                        <br>
                                    </td>
                                    <td class="text-center">
                                        <input type="text" disabled id="total_time" style="width:20%;">
                                    </td>
                                </tr>
                            </tbody>
                            <tbody id="table_saturday">
                                <tr>
                                    <td class="text-left">
                                        <label>SATURDAY</label>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-primary " data-day="saturday"
                                            onclick="add_row_am(this)">AM</button>
                                        <button class="btn btn-sm btn-primary " data-day="saturday"
                                            onclick="add_row_pm(this)">PM</button>
                                        <input type="text" hidden name="day" value="saturday">
                                    </td>
                                    <td class="text-center">
                                        <b>AM</b>
                                    </td>
                                    <td class="text-center">
                                        <input type="text" hidden name="time_frame" value="AM">
                                        <input type="time" name="start" onchange="check_am_time(this)">
                                        TO
                                        <input type="time" name="end" onchange="check_am_time(this)">
                                        <br>
                                    </td>
                                    <td class="text-center">
                                        <div style="display: flex; align-items: center;">
                                            <select class="text-center" name="subject"
                                                style="width:88%; height:1.8rem;">
                                                <option value="" selected disabled>SELECT SUBJECT</option>
                                                <?php
                                                foreach ($subjects as $key => $data) { ?>
                                                    <option value="<?= $data->Subject_name ?>">
                                                        <?= $data->Subject_name ?>
                                                    </option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                            <button class="btn btn-sm btn-success" onclick="add_subject(this)"
                                                style="width:12%; height:1.8rem;"><i class="fas fa-list"></i></button>
                                        </div>
                                        <br>
                                    </td>
                                    <td class="text-center">
                                        <input class="text-center" type="text" name="room" style="width:60%;"
                                            placeholder="ROOM #">
                                        <br>
                                    </td>
                                    <td class="text-center">
                                        <input type="text" disabled id="total_time" style="width:20%;">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer" style="background-color:#9f3a3b;">
                        <button type="button" class="btn btn-success" data-toggle="modal"
                            style="margin-left:87%; width:10rem;" data-target="#modal-default" id="Save">
                            Encode Schedule
                        </button>
                        <!-- <button type="button" class="btn btn-warning" id="debug">Debug</button> -->
                    </div>
                </div>
            </div>
            <!-- <div class="col-sm-9">
                <table class="table border-in-table table-hover table-sm">
                    <thead>
                        <tr>
                            <th style="width: 5%;">#</th>
                            <th style="width: 15%;">FACULTY ID</th>
                            <th style="width: 20%;">SUBJECT</th>
                            <th style="width: 10%;">ROOM</th>
                            <th style="width: 10%;">DAY</th>
                            <th style="width: 15%;">START TIME</th>
                            <th style="width: 10%;">END TIME</th>
                            <th style="width: 10%;">ACTION</th>
                        </tr>
                    </thead>
                    <h5>Schedule</h5>
                    <tbody id="load_schedule"></tbody>
                </table>
            </div> -->
        </div>
    </div>
</section>


<!-- CONFIRMATION MODAL SAVE -->
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Action Irreversable! <br> Make sure the data entered is final and correct</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- <div class="modal-body">
        <p>One fine body&hellip;</p>
      </div> -->
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="save_schedule"
                    data-samplefile="">Confirm/Save</button>
            </div>
        </div>
    </div>
</div>
<!-- ############ PAGE END-->
<?php
main_footer();
?>
<script src="<?php echo base_url() ?>/assets/js/sched_upload/sched_upload.js"></script>
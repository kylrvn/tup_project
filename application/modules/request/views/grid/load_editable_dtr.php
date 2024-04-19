<?php
// var_dump($data);
?>
<!-- <label> Request by: <b><?= strtoupper($value->Lname) ?>, <?= strtoupper($value->Fname) ?><?= strtoupper($value->Mname) ?></b></label> -->
<table class="table table-hover text-nowrap">
    <thead>
        <tr>
            <th>#</th>
            <th>DAY</th>
            <th>DATE</th>
            <th>TIME IN AM</th>
            <th>TIME OUT AM</th>
            <th>TIME IN PM</th>
            <th>TIME OUT PM</th>
            <th>DATE UPDATED</th>
            <th>ACTION</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($data as $key => $value) {
            ?>
            <tr>
                <td hidden>
                    <input type="date" id="date_default" value="<?=date("Y-m-d", strtotime($value->date_log))?>">
                </td>
                <td>
                    <b>
                        <?= @$key + 1 ?>
                    </b>
                </td>
                <td>
                    <b><?= (new DateTime($value->date_log))->format('l') ?></b>
                </td>
                <td>
                    <?= (new DateTime($value->date_log))->format('F j, Y') ?>
                </td>
                <td>
                    <input type="time" id="time_in_am" value="<?= $value->timein_am == null || empty($value->timein_am) ? '' : date("H:i", strtotime($value->timein_am))?>">
                    <input type="date" hidden id="dateTimeIn_am" value="<?= $value->timein_am == null ? '': date("Y-m-d", strtotime($value->timein_am))?>" >
                </td>
                <td>
                    <input type="time" id="time_out_am" value="<?= $value->timeout_am == null || empty($value->timeout_am) ? '' : date("H:i", strtotime($value->timeout_am))?>">
                    <input type="date" hidden id="dateTimeOut_am" value="<?= $value->timeout_am == null ? '': date("Y-m-d", strtotime($value->timeout_am))?>" >
                </td>
                <td>
                    <input type="time" id="time_in_pm" value="<?= $value->timein_pm == null || empty($value->timein_pm) ? '' : date("H:i", strtotime($value->timein_pm))?>">
                    <input type="date" hidden id="dateTimeIn_pm" value="<?= $value->timein_pm == null ? '': date("Y-m-d", strtotime($value->timein_pm))?>" >
                </td>
                <td>
                    <input type="time" id="time_out_pm" value="<?= $value->timeout_pm == null || empty($value->timeout_pm) ? '' : date("H:i", strtotime($value->timeout_pm))?>">
                    <input type="date" hidden id="dateTimeOut_pm" value="<?= $value->timeout_pm == null ? '': date("Y-m-d", strtotime($value->timeout_pm))?>" >
                </td>
                <td>
                    <b class="text-primary"><?= (new DateTime($value->date_updated))->format('F j, Y') ?></b>
                </td>
                <td>
                    <button class="btn btn-success btn-sm" onclick="update_entry(this)" data-log_id="<?=$value->ID?>">Update Entry</button>
                </td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>
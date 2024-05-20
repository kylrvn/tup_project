<?php
// var_dump($details);
?>

<table class="table table-hover text-nowrap">
    <thead>
        <tr>
            <th>#</th>
            <th>REQUEST BY</th>
            <th>CONCERN</th>
            <th>DATE UPLOADED</th>
            <th class="text-center">STATUS</th>
            <th>ACTIONS</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($details as $key => $value) {
            ?>
            <tr>
                <td><b>
                        <?= @$key + 1 ?>
                    </b></td>
                <td>
                    <?= ucfirst($value->Lname) ?>,
                    <?= ucfirst($value->Fname) ?>
                    <?= ucfirst($value->Mname) ?>
                </td>
                <td>
                    <?= $value->LeaveType ?>
                </td>
                <td><?= $value->Date_Uploaded ?></td>
                <td class="text-center">
                    <?= $value->verified == "0" ? '<label style="color: red;">UNVERIFIED</label>' : '<label style="color: green;">VERIFIED</label>' ?>
                </td>
                <td>
                    <button class="btn btn-primary btn-sm" data-id="<?= $value->ID ?>" onclick="view_file(this)"><i
                            class="fas fa-eye"></i></button>
                    <button class="btn btn-success btn-sm" <?= $value->verified == "1" ? 'disabled' : '' ?>
                        data-id="<?= $value->ID ?>" onclick="verify_file(this)"><i class="fas fa-check"></i> VERIFY</button>
                </td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>
<!-- MODAL -->
<div class="modal fade" id="view_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div id="modal_content"></div>
        </div>
    </div>
</div>
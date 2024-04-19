<?php
// var_dump($details);
?>


    <table class="table table-hover text-nowrap">
        <thead>
            <tr>
                <th>#</th>
                <th>REQUEST BY</th>
                <th>REASON</th>
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
                        <?= $value->ForVerifReason ?>
                    </td>
                    <td class="text-center"><?= $value->ForVerifStatus == "0"? '<label style="color: red;">UNVERIFIED</label>' : '<label style="color: green;">VERIFIED</label>' ?></td>
                    <td>
                        <button class="btn btn-primary btn-sm" data-faculty_id="<?= $value->FacultyID ?>" data-schedule="<?= $value->Schedule ?>" onclick="view_dtr(this)"><i class="fas fa-eye"></i></button>
                        <button class="btn btn-success btn-sm" <?= $value->ForVerifStatus == "1"? 'disabled' : ''?> data-id="<?= $value->ID ?>" onclick=""><i class="fas fa-check"></i> VERIFY</button>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>

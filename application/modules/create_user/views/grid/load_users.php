<?php
$ci = &get_instance();
if (!empty($details)) {
    foreach ($details as $key => $value) {
        ?>
        <tr onclick="click_user(this)" data-ID="<?= $value->ID ?>" data-Lname="<?= $value->Lname ?>"
            data-Fname="<?= $value->Fname ?>" data-Mname="<?= $value->Mname ?>" data-Suffix="<?= $value->Suffix ?>"
            data-Address="<?= $value->Address ?>" data-Contact_Number="<?= $value->Contact_Number ?>"
            data-Sex="<?= $value->Sex ?>" data-Age="<?= $value->Age ?>" data-Estatus="<?= $value->Estatus ?>"
            data-Faculty_number="<?= $value->Faculty_number ?>" data-Department="<?= $value->Department ?>"
            data-Rank="<?= $value->Rank ?>" data-User_type="<?= $value->User_type ?>" data-Username="<?= $value->Username ?>">
            <td>
                <?= $value->Faculty_number ?>
            </td>
            <td>
                <?= strtoupper($value->Lname) ?>,
                <?= strtoupper($value->Fname) ?>
                <?= strtoupper(substr($value->Mname, 0, 1)) ?>.
            </td>
            <td>
                <?=
                    $value->User_type == "1" ? "Faculty" : (
                        $value->User_type == "2" ? "Program Head" : (
                            $value->User_type == "3" ? "HR" : ""
                        ))
                    ?>

            </td>
            <td>
                <?= $value->department_name ?>
            </td>
        </tr>
        <?php
    }
} else {
    ?>
    <tr>
        <td colspan="7">
            <div>
                <center>
                    <h6 style="color:red">No Data Found.</h6>
                </center>
            </div>
        </td>
    </tr>
    <?php

}
?>
<?php
var_dump($details);
$ci = &get_instance();
if (!empty($details)) {
    foreach ($details as $key => $value) {
        ?>
<tr>
    <td>
        <?= @$key + 1 ?>
    </td>
    <td>
        <?= (@$value->Subject_name) ?>
    </td>
    <td class="text-center">
        <span><i class="fas fa-square" style="color:<?=@$value->color?>"></i></span>
    </td>
    <td>
        <?= (@$value->department_name) ?>
    </td>
    <td>
        <?= (@$value->Active == 1 ? "Active" : "In-Active") ?>
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
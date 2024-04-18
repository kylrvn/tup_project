<?php
    if(!empty($details)){
        foreach ($details as $key => $value) {
            ?>
                <tr onclick="click_department(this)" 
                data-id="<?=$value->ID?>"
                data-department="<?=$value->department_name?>"
                data-status="<?=$value->status?>"
                >
                    <td><?=@$key+1?></td>
                    <td><?=(@$value->department_name)?></td>
                    <td><?=(@$value->status)?></td>        
                </tr>
            <?php  
        }        
    }
    else{
        ?>
            <tr>
                <td colspan="7">
                    <div><center><h6 style="color:red">No Data Found.</h6></center></div>
                </td>
            </tr>
        <?php
        
    }
?>
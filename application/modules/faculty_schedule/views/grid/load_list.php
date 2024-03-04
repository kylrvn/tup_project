<?php
    $ci = & get_instance();
    if(!empty($details)){
        foreach ($details as $key => $value) {
            ?>
                <tr>
                    <td><?=(@$value->Doc_name)?></td>
                    <td><?=(@$value->Description)?></td>
                    <td><?=@$value->Category_ID?></td>
                    <td><?=@$value->Remarks?></td>
                    <td><?=@$value->Publish_by?></td>
                    <td><?=date("M d, Y", strtotime(@$value->Publish_date))?></td>
                    <td><?=date("M d, Y", strtotime(@$value->Date_created))?></td>                   
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
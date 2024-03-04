<!-- dash_grid -->
<?php
    $ci = & get_instance();
    if(!empty($details)){
        foreach ($details as $key => $value) {
            ?>
                <tr>
                    <td><?=@$value->->Status ?></td>
                    
                </tr>
            <?php  
        }        
    }else{
        ?>
            <tr>
                <td colspan="7">
                    <div><center><h6 style="color:red">No Data Found.</h6></center></div>
                </td>
            </tr>
        <?php
        
    }
?>
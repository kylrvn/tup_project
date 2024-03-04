<?php
    $prevCat = '';
    foreach($list as $key => $value){ 
    ?>
    <tr onClick="editFunctionList(<?=$value->ID?>)" >
        <td>
            <?php
                if($prevCat == $value->List_category) {
                    $Cat = '';
                } else {
                    $Cat = $prevCat = $value->List_category;
                }
                echo $Cat;
            ?>
        </td>
        <td><?=ucfirst($value->List_name)?></td>
    </tr>
<?php   
}

?>

<table class="table border-in-table table-hover table-sm">
<thead>
    <tr>
        <th>Publication</th>
    </tr>
</thead>



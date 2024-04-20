<?php
// var_dump($details);
?>

<div class="card-header">
    <h3 class="card-title"><b>Select Faculty</b></h3>

    <div class="card-tools">
        <div class="input-group input-group-sm" style="width: 150px;">
            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

            <div class="input-group-append">
                <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </div>
</div>
<div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
        <thead>
            <tr>
                <th>#</th>
                <th>FACULTY NAME</th>
                <th>DEPARTMENT</th>
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($details as $key => $value) {
                ?>
                <tr>
                    <td><b><?=@$key+1?></b></td>
                    <td><?=ucfirst($value->Lname)?>, <?=ucfirst($value->Fname)?> <?=ucfirst($value->Mname)?></td>
                    <td><?=$value->department_name?></td>
                    <td>
                        <button class="btn btn-sm btn-success" onclick="load_calendar(this)" data-id="<?=$value->ID?>"><i class="fas fa-calendar"></i></button>
                        <button class="btn btn-sm btn-primary" onclick="load_dtr(this)" data-id="<?=$value->ID?>"><i class="fas fa-calendar"></i></button>
                        <!-- <button class="btn btn-sm btn-success" onclick="load_calendar(this)" data-id="<?=$value->ID?>"><i class="fas fa-calendar"></i></button> -->
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>
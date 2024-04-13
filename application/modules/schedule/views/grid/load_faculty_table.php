<?php
?>

<div class="card-header">
    <h3 class="card-title"><b>Select Faculty</b></h3>

    <div class="card-tools">

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
                // var_dump($value);
                ?>
                <tr>
                    <td><b><?= @$key + 1 ?></b></td>
                    <td><?= ucfirst($value->Lname) ?>, <?= ucfirst($value->Fname) ?>    <?= ucfirst($value->Mname) ?></td>
                    <td><?= $value->department_name ?></td>
                    <td>
                        <button class="btn btn-sm btn-success" onclick="load_calendar(this)" data-id="<?= @$value->ID ?>" style="display:<?=@$loaded_from == "load_faculty_list" ? 'none' : '' ?>"><i
                                class="fas fa-calendar"></i></button>
                        <button class="btn btn-sm btn-primary" onclick="set_exam_schedule(this)" data-id="<?= @$value->ID ?>" data-dept_id="<?= @$value->department_id ?>" style="display:<?=@$loaded_from == "load_faculty_list" ? '' : 'none' ?>"><i
                            class="fas fa-eye"></i></button>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>
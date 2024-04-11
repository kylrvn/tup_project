<?php
// var_dump($details);
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
                    <td><?= ucfirst($value->Lname) ?>, <?= ucfirst($value->Fname) ?>     <?= ucfirst($value->Mname) ?></td>
                    <td><?= $value->department_name ?></td>
                    <td>
                        <button class="btn btn-sm btn-success" onclick="load_calendar(this)" data-id="<?= $value->ID ?>"><i
                                class="fas fa-calendar"></i></button>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>
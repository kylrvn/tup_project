
<table class="table table-bordered">
    <thead>
        <tr>
            <th style="width: 10px">#</th>
            <th>Approve Schedule</th>
            <th>DTR Schedule</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($details as $key => $value){ ?>
            <input type="hidden" id="faculty_id" value="<?=$value->FacultyID?>">
        <tr>
            <td><?= $key + 1 ?></td>
            <td><input type="checkbox" name="approveDate[]" data-ID="<?=$value->ID?>"></td>
            <td><?= $value->Schedule ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>

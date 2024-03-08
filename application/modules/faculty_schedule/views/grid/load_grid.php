<?php
// var_dump($details);
$ci = &get_instance();
if (!empty($details)) {
    foreach ($details as $key => $value) {
        ?>
        <tr onclick="update(this)" data-ID="<?= $value->ID ?>" data-faculty_id="<?= $value->Faculty_id ?>"
            data-day="<?= $value->Day ?>" data-room="<?= $value->Room ?>" data-start_time="<?= $value->Start_time ?>"
            data-end_time="<?= $value->End_time ?>" data-subject="<?= $value->Subject ?>">
            <td>
                <?= $key + 1 ?>
            </td>
            <td><?= $value->Faculty_id ?></td>
            <td><?= $value->Subject ?></td>
            <td><?= $value->Room ?></td>
            <td><?= $value->Day ?></td>
            <td><?= $value->Start_time ?></td>
            <td><?= $value->End_time ?></td>
            <td>
                <button type="button" class="btn btn-danger btn-sm delbtn" data-id="<?= @$value->ID ?>"><i
                        class="fa fa-trash"></i></button>
                <!-- <a class="btn btn-sm btn-primary" href="<?php echo base_url() ?>phonebook/contact_profile/<?= @$value->ID ?>"><i class="fa fa-pencil"></i></a> -->
            </td>
        </tr>
    <?php
    }
} else {
    ?>
    <tr>
        <td colspan="8">
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

<script>
    // $('#delete').click(function() {
    //     alert();

    // });

    // $(document).on("click", '.delbtn', function () {
    //     var xy = $(this).closest("tr").data("id");
    //     alert(xy);
    //     console.log(xy);
    // });
    $('.delbtn').click(function () {
        var xy = $(this).data("id");
        $.post({
            url: 'faculty_schedule/service/Faculty_schedule_service/delete',

            data: {
                sched_id: $(this).data("id"),

            },
            // success:function(e)
            //     {
            //         var e = JSON.parse(e);
            //         if(e.has_error == false){
            //             $('#modal-default').modal('hide');
            //             toastr.success(e.message);
            //             load_list();
            //             setTimeout(function(){
            //               window.location.reload();
            //           },2000); 

            //         } else {
            //           $('#List').attr('class', 'form-control inpt is-invalid');
            //           $('#modal-default').modal('hide');
            //           toastr.error(e.message); 
            //         }
            // },
        })
    });

</script>
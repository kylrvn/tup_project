<?php
$file_extension = pathinfo($image->Filename, PATHINFO_EXTENSION);
?>
<div class="modal-header " style="background-color:#9F3A3B; color: white;">
    Date Uploaded: <?= $image->Date_Uploaded ?>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <!-- <?= var_dump($file_extension) ?> -->
    <?php
    if ($file_extension == "pdf" || $file_extension == "docx") { ?>
        <iframe src="<?php echo base_url(); ?>assets/uploads/<?= $image->Filename ?>" width="100%"
            height="700"></iframe>
        <?php
    } else if ($file_extension == "png" || $file_extension == "jpg" || $file_extension == "jpeg") { ?>
            <div style="position: relative; display: inline-block;">
                <img src="<?php echo base_url(); ?>assets/uploads/<?= $image->Filename ?>"
                    style="width: 100%; height:100%; object-fit: contain;">
            </div>
        <?php
    } ?>
</div>
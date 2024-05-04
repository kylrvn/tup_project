<?php
main_header(['calendar']);
?>
<div class="row ml-2">
    <div class="col-md-3">
        <div class="sticky-top">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><b>Events</b></h4>
                </div>
                <div class="card-body">
                    <!-- the events -->
                    <div id="external-events">
                        <div class="external-event bg-gray">Non-working Day</div>
                        <div class="external-event bg-warning">Special Non-Working day</div>
                        <div class="external-event bg-success">Holiday</div>
                        <div class="checkbox" hidden>
                            <label for="drop-remove">
                                <input type="checkbox" id="drop-remove">
                                remove after drop
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button class="btn btn-success float-right" id="save_dates" style="width:100%;">Save Calendar</button>

    </div>
    <!-- /.col -->
    <div class="col-md-9">
        <div class="card card-primary">
            <div class="card-body p-0" id="print_calendar" style="zoom:80%;">
                <!-- THE CALENDAR -->
                <div id="calendar"></div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>

<!-- <button class="btn btn-primary float-right" id="print_button" style="width:30%;">Print</button> -->
<input hidden id="baseUrl" value="<?=base_url()?>">
<?php
calendar_footer();
?>
<!-- printThis Function -->
<script src="<?= base_url() ?>assets/js/printThis/printThis.js"></script>
<script src="<?php echo base_url() ?>/assets/js/non_working/non_working.js"></script>
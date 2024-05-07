<?php
calendar_header();
?>

<head>
    <style>
        .fc-event {
            display: block;
            align-items: center;
            justify-content: center;
            text-align: center;
            font-size: 80%;
        }

        .fc-event-title.fc-sticky {
            padding-top: 20%;
            white-space: pre-line;
        }

        /* .fc.fc-media-screen.fc-direction-ltr.fc-theme-bootstrap {
            height:150vh;
        } */
    </style>
</head>

<center>
    <div class="row" hidden>
        <div class="col-md-3">
            <div class="sticky-top mb-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Draggable Events</h4>
                    </div>
                    <div class="card-body">
                        <!-- the events -->
                        <div id="external-events">
                            <div class="external-event bg-success">Lunch</div>
                            <div class="external-event bg-warning">Go home</div>
                            <div class="external-event bg-info">Do homework</div>
                            <div class="external-event bg-primary">Work on UI design</div>
                            <div class="external-event bg-danger">Sleep tight</div>
                            <div class="checkbox">
                                <label for="drop-remove">
                                    <input type="checkbox" id="drop-remove">
                                    remove after drop
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <paper class="row" id="print_calendar">
        <!-- <div style="justify-content: center; align-text:center; width:100%;">
            <div class="card-header text-center border-all-no-bottom">
                <img src="<?= base_url() ?>assets/images/Logo/tuplogo.png" width="15%" height="15%">
                <label>
                    Technological University of the Philippines Visayas
                    <br>
                    Capt. Sabi St., City of Talisay, Negros Occidental
                    <br>
                    <br>
                    FACULTY DAILY ATTENDANCE CHART
                    <br>
                    TARDINESS/UNDERTIME
                </label>
            </div>
        </div> -->
        <!-- THE CALENDAR -->
        <div class="row">
            <div class="col-md-12">
                <div id="calendar_schedule"></div>
            </div>
        </div>
    </paper>
    <button class="btn btn-primary float-right" id="print_button" style="width:30%;">Print</button>
</center>



<?php
calendar_footer();
?>
<!-- printThis Function -->
<script src="<?= base_url() ?>assets/js/printThis/printThis.js"></script>
<script src="<?php echo base_url() ?>/assets/js/schedule/schedule.js"></script>
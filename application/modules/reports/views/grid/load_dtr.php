<?php

// var_dump($details["selected_month"]);
?>

<head>
    <style>
    #print_DTR {
        font-family: 'Times New Roman', Times, serif;
    }
    </style>
</head>

<!-- Content Here -->
<div class="row" id="print_DTR">
    <div class="col-12">
        <div class="card" style="font-size:70%;">
            <div class="card-header text-left">
                <label style="font-size: 140%;">
                    CIVIL SERVICE FORM NO. 48
                </label>
            </div>
            <div style="margin-top:1rem;">
                <label class="text-center" style="font-size: 170%;">
                    DAILY TIME RECORD
                </label>
            </div>
            <div style="margin-top:1rem;">
                <label class="text-center" style="font-size: 150%;" id="faculty">
                    <?= $details["faculty_details"] == null ? "CHOOSE FACULTY" : strtoupper($details["faculty_details"]->Lname) . ", " . strtoupper($details["faculty_details"]->Fname) . " " . strtoupper(substr($details["faculty_details"]->Mname, 0, 1)) . "." ?>
                </label>
            </div>
            <div class="d-flex justify-content-center">
                <label class="text-center"
                    style="font-size: 120%; border-top: solid black 2px; padding-top: 2px; width: 80%;">
                    (Name)
                </label>
            </div>
            <div class="card-header text-left">
                <label style="font-size: 120%;">
                    For the month of &nbsp;
                    <cont style="border-bottom: solid black 1px; padding-bottom: 1px;">
                        <?= $details["selected_month"] ?>
                    </cont><br>

                    Official hours for regular days &nbsp;
                    <cont style="border-bottom: solid black 1px; padding-bottom: 1px;">
                        9999
                    </cont><br>

                    Arrival and departure on regular days &nbsp;
                    <cont style="border-bottom: solid black 1px; padding-bottom: 1px;">
                        9999
                    </cont><br>
                </label>
            </div>
            <div class="card-body table-responsive p-0" style="width: 97%; margin: 0 auto;">
                <table class="table-black" style="width: 100%;">
                    <thead>
                        <tr style="border-bottom: solid black 1px;">
                            <th class="center-text" colspan="4" style="">AM</th>
                            <th class="center-text" colspan="4" style="border-left: solid black 1px;">PM</th>
                            <th class="center-text" colspan="4" style="border-left: solid black 1px;">
                                UNDERTIMES</th>
                        </tr>
                    </thead>
                    <thead>
                        <tr style="border-bottom: solid black 1px;">
                            <th class="center-text" colspan="2" style="">Arrival</th>
                            <th class="center-text" colspan="2" style="border-left: solid black 1px;">Departure</th>
                            <th class="center-text" colspan="2" style="border-left: solid black 1px;">Arrival</th>
                            <th class="center-text" colspan="2" style="border-left: solid black 1px;">Departure</th>
                            <th class="center-text" colspan="2" style="border-left: solid black 1px;">Arrival</th>
                            <th class="center-text" colspan="2" style="border-left: solid black 1px;">Departure</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
<button class="btn btn-sm btn-primary">Print</button>
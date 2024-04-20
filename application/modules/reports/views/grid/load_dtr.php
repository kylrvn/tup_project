<?php

// var_dump($details["num_of_days"]);

$number_of_days = $details["num_of_days"];
$daysArray = range(1, $number_of_days);

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
    <div class="col-6" id="mirror">
        <!-- Universal font adjustment -->
        <div class="card" style="font-size:80%;">
            <div class="card-header text-left">
                <label style="font-size: 150%;">
                    CIVIL SERVICE FORM NO. 48
                </label>
            </div>
            <div style="margin-top:1rem;">
                <label class="text-center" style="font-size: 180%;">
                    DAILY TIME RECORD
                </label>
            </div>
            <div style="margin-top:1rem;">
                <label class="text-center" style="font-size: 170%;" id="faculty">
                    <?= $details["faculty_details"] == null ? "CHOOSE FACULTY" : strtoupper($details["faculty_details"]->Lname) . ", " . strtoupper($details["faculty_details"]->Fname) . " " . strtoupper(substr($details["faculty_details"]->Mname, 0, 1)) . "." ?>
                </label>
            </div>
            <div class="d-flex justify-content-center">
                <label class="text-center"
                    style="font-size: 130%; border-top: solid black 2px; padding-top: 2px; width: 80%;">
                    (Name)
                </label>
            </div>

            <font_size style="font-size: 130%;">
                <div class="card-header text-left">
                    <label>
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
                                <th class="center-text" colspan="2" style="border-left: solid black 1px;">Hours</th>
                                <th class="center-text" colspan="2" style="border-left: solid black 1px;">Minutes</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($daysArray as $key => $day) {
                                ?>
                                <tr style="border-bottom: solid black 1px;">
                                    <td class="center-text" colspan="0.5">
                                        <?= $day ?>
                                    </td>
                                    <td class="center-text" colspan="1.5" style="border-left: solid black 1px;">
                                        Place_Holder
                                    </td>
                                    <td class="center-text" colspan="2" style="border-left: solid black 1px;">
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                    </td>
                                    <td class="center-text" colspan="2" style="border-left: solid black 1px;">
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                    </td>
                                    <td class="center-text" colspan="2" style="border-left: solid black 1px;">
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                    </td>
                                    <td class="center-text" colspan="2" style="border-left: solid black 1px;">
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                    </td>
                                    <td class="center-text" colspan="2" style="border-left: solid black 1px;">
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    <div>
                        <!-- Underlines -->
                        <div style="margin-top: 3px; width: 100%; height: 2px; background-color: black;"></div>
                        <div style="margin-top: 3px; width: 100%; height: 2px; background-color: black;"></div>
                    </div>

                    <div style=" text-align:right;">
                        <label style="font-size: 130%;">
                            TOTAL
                        </label>
                        <input type="text"
                            style="border-top: none; border-right: none; border-left: none; border-bottom: solid black 1px; padding-bottom: 1px;text-align: center; width:50%;">

                    </div>

                    <div>
                        <!-- Underlines -->
                        <div style="margin-top: 1px; width: 100%; height: 2px; background-color: black;"></div>
                        <div style="margin-top: 3px; width: 100%; height: 2px; background-color: black;"></div>
                    </div>

                    <div>
                        <label class="mt-1" style="margin-left:3%; margin-right:3%; font-weight:530;">
                            I hereby on my honor that the above is true and correct out of the hours of work performed
                            record of which was made.
                        </label>
                        <br>
                        <br>
                    </div>

                    <div style=" text-align:right;">
                        <input type="text"
                            style="border-top: none; border-right: none; border-left: none; border-bottom: solid black 2px; padding-bottom: 1px;text-align: center; width:40%;">
                    </div>

                    <div>
                        <!-- Underlines -->
                        <div style="margin-top: 5px; width: 100%; height: 2px; background-color: black;"></div>
                        <div style="margin-top: 3px; width: 100%; height: 2px; background-color: black;"></div>
                    </div>

                    <div>
                        <label class="mt-1" style="margin-left:3%; margin-right:3%; font-weight:530;">
                            Verified on the prescribed office hours
                        </label>
                        <br>
                        <br>
                    </div>

                    <div style="text-align:right;">
                        <input type="text"
                            style="border-top: none; border-right: none; border-left: none; border-bottom: solid black 2px; padding-bottom: 1px;text-align: center; width:40%;">
                        <div style="text-align: right; margin-right:9%;">
                            <p>Immediate Supervisor</p>
                        </div>
                    </div>



                </div>
            </font_size>

        </div>
    </div>

    <div class="col-6" id="load_mirror">
        <!-- Mirror Loaded Here -->
    </div>

</div>
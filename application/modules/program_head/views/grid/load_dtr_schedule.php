

<table class="table table-bordered">
    <thead>
        <tr>
            <th style="width: 10px">#</th>
            <th>Approve Schedule</th>
            <th>DTR Schedule</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($details as $key => $schedule): ?>
        <input type="hidden" id="faculty_id" value="<?= $schedule->FacultyID ?>">
        <tr>
            <td><?= $key + 1 ?></td>
            <td><input type="checkbox" name="approveDate[]" data-ID="<?= $schedule->ID ?>"></td>
            <td>
                <div id="accordion_<?= $schedule->ID ?>">
                    <div class="card card-default">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                <a class="d-block w-100" style="color:brown" data-toggle="collapse" href="#collapseOne_<?= $schedule->ID ?>">
                                    <?= $schedule->Schedule ?>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseOne_<?= $schedule->ID ?>" class="collapse" data-parent="#accordion_<?= $schedule->ID ?>">
                            <div class="card-body">
                                <table>
                                    <?php foreach($results as $logs): ?>
                                        <?php foreach($logs as $log): ?>
                                            <?php
                                            // Convert log date to match the schedule format for comparison
                                            $logDate = date('M d, Y', strtotime($log->date_log));
                                            $scheduleDates = explode(' - ', $schedule->Schedule);
                                            $startDate = date('M d, Y', strtotime($scheduleDates[0]));
                                            $endDate = date('M d, Y', strtotime($scheduleDates[1]));

                                            if ($logDate >= $startDate && $logDate <= $endDate):
                                            ?>
                                            <tr>
                                                <td><?= $logDate . ' ' . date('h:i:a', strtotime($log->date_log)) ?></td>
                                            </tr>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php endforeach; ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>

</table>

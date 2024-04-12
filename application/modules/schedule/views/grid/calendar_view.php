<?php
$year = date('Y');
$month = date('m');
$day = date('d');
?>

<div class="calendar">
    <?= $this->calendar->generate($year, $month) ?>
</div>
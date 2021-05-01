<?php
$start = strtotime('2021-04-10 12:01:00');
$end = strtotime('2021-04-10 12:30:59');
$mins = ($end - $start) / 60;
echo $mins;
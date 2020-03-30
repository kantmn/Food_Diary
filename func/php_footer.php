<?php
$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$finish = $time;
$total_time = round(($finish - $start_time), 3)*1000;
$total_ram = round(((memory_get_usage() - $start_memory)/1024),0);

echo 'Generated in '.$total_time.' ms and used '.$total_ram.' KBytes';
//echo ' with <span id="sql_counter">'.$sql_count.'</span> Queries';
echo ' &copy; Copyright '.date('Y').' by Roebig';
?>
<? exit; ?>
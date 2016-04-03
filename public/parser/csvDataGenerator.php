<?php

$f=0;
date_default_timezone_set('Asia/Kolkata');
set_time_limit(0);
$noOfMeters= 8;
$file_name = "multi_test.csv";
while($f==0) {
    $display_msg = "Values added - ";
    $date = date("d-m-y");
    $time = date("H:i:s");
    $each_line_in_file = "".$date.",".$time.","."22,1,1,";
    for($i=0;$i<$noOfMeters;$i++) {
        $str = rand(0, 1000);
        $spd = rand(0, 100);
        $rt = rand_date("0:00:00", "24:00:00");
        $str_name = "str" + ($i+1);
        $spd_name = "spd" + ($i+1);
        $rt_name = "rt" + ($i+1);
        $display_msg .= $str_name . " - " . $str . " , " . $spd_name . " - " .$spd . " , " . $rt_name . " - " . $rt ;
        $each_line_in_file .= $str . "," . $spd . "," . $rt . ",";
    }
    $each_line_in_file .= "\n";
    echo $display_msg . "<br><br>";
    $csvFile = fopen("".$file_name."","a");
    fwrite($csvFile,"".$each_line_in_file);
    fclose($csvFile);
    usleep(10000000);
}

function rand_date($min_date, $max_date) {
    $min_epoch = strtotime($min_date);
    $max_epoch = strtotime($max_date);
    $rand_epoch = rand($min_epoch, $max_epoch);
    return date('H:i:s', $rand_epoch);
}

?>
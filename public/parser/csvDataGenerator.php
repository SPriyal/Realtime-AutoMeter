<?php

$f=0;
date_default_timezone_set('Asia/Kolkata');
set_time_limit(0);
$noOfMeters= 8;
$file_name = "multi_test.csv";
$totalValueInStr = array();
$totalValueInRt = array();
$randomNumberForRtIF = array();
$dateChangerCounter = array();
$totalValueInSpd = array();
$fileHandler = file($file_name);
$lastLine = $fileHandler[sizeof($fileHandler) - 1];
$data = str_getcsv($lastLine);
if(validateDate($data[0])) {
    echo "==============inside validator of date... data exists!<br/>";
    for ($i = 0,$j=5; $i < $noOfMeters; $i++,$j+=3) {
        echo "<br/>str[$i] is $data[$j]";
        $totalValueInStr[$i] = $data[$j];
        echo "<br/>rt[$i] is ".$data[$j+2];
        $totalValueInRt[$i] = $data[$j+2];
        echo "<br/>spd[$i] is ".$data[$j+1];
        $totalValueInSpd[$i] = $data[$j+1];
        $randomNumberForRtIF[$i] = mt_rand(3, 20);
        $dateChangerCounter[$i] = 0;
    }
}else{
    echo "=============data doesnt exists!<br/>";
    for ($i = 0; $i < $noOfMeters; $i++) {
        $totalValueInStr[$i] = mt_rand(2000, 3000);
        $totalValueInRt[$i] = "0:00:00";
        $totalValueInSpd[$i] = 16.0;
        $randomNumberForRtIF[$i] = mt_rand(3, 20);
        $dateChangerCounter[$i] = 0;
    }
}

while($f==0) {
    $display_msg = "Values added - ";
    $date = date("d/m/y");
    $time = date("H:i:s");
    $each_line_in_file = "".$date.",".$time.","."22,1,1,";
    for($i=0;$i<$noOfMeters;$i++) {
        $strCurrentMinute = mt_rand(000,260) / 10;
        $totalValueInStr[$i] += $strCurrentMinute;
        $spd = rand(0, 100);
        $totalValueInSpd[$i] += mt_rand(-10,10)/10;
        if($dateChangerCounter[$i] == $randomNumberForRtIF[$i]) {
            $totalValueInRt[$i] = incrementTime($totalValueInRt[$i], 1);
            $dateChangerCounter[$i] = 0;
            $randomNumberForRtIF[$i] = mt_rand(3,20);
        }
        else
            $totalValueInRt[$i] = incrementTime($totalValueInRt[$i], 0);
        $str_name = "str" + ($i+1);
        $spd_name = "spd" + ($i+1);
        $rt_name = "rt" + ($i+1);
        $display_msg .= $str_name . " - " . $totalValueInStr[$i] . " , " . $spd_name . " - " .$totalValueInSpd[$i] . " , " . $rt_name . " - " . $totalValueInRt[$i] ;
        $each_line_in_file .= $totalValueInStr[$i] . "," . $totalValueInSpd[$i] . "," . $totalValueInRt[$i] . ",";
        $dateChangerCounter[$i]++;
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

function incrementTime($time,$incrementalFlag){
    if($incrementalFlag == 1) {
        $randomSecondNumber = rand(40, 60);
        $newTime = strtotime($time) + $randomSecondNumber;
    }
    else
        $newTime = strtotime($time) + 60;
    return date('H:i:s',$newTime);
}

function validateDate($date)
{
    $d = DateTime::createFromFormat('d/m/y', $date);
    return $d && $d->format('d/m/y') === $date;
}
?>
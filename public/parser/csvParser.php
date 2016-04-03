<?php
$conn = new mysqli("localhost", "idp", "pass", "bm");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$noOfMeters= 8;
$file_name = "multi_test.csv";
$table_name = "data3";
date_default_timezone_set('Asia/Kolkata');
set_time_limit(0);
$fileHandler = file($file_name);
$lastLine = $fileHandler[sizeof($fileHandler) - 1];
$data = str_getcsv($lastLine);
$dateTime = $data[0] . " " . $data[1];
$zone = $data[2];
$din = $data[3];
$status = $data[4];
for($j=0,$k=0;$j<$noOfMeters;$j++,$k+=3) {
    $str1 = $data[5+$k];
    $spd1 = $data[6+$k];
    $rt1 = $data[7+$k];
    $str_id = 9+$k;
    $spd_id = 10+$k;
    $rt_id = 11+$k;
    $str_parameterName = "str" . ($j+1) ;
    $spd_parameterName = "spd" . ($j+1) ;
    $rt_parameterName = "rt" . ($j+1) ;
    $currentDateTime = date("d-m-Y H:i:s");
    $currentDateTime_Less = date("d-m-y H:i:s", strtotime($currentDateTime) - 2);
    $currentDateTime_More = date("d-m-y H:i:s", strtotime($currentDateTime) + 2);
    echo "<br><br><br><h2>Parsing for 'Stenter".($j+1). "' is under Progress...</h2>";
    if (strtotime($dateTime) < strtotime($currentDateTime_More) && strtotime($dateTime) > strtotime($currentDateTime_Less)) {
        $sql = "SELECT * FROM ".$table_name." where DateTime = " . "'" . $dateTime . "' AND meter_id = ". "'" . $str_id . "'" ;
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0)
            $flag = 1;
        else
            $flag = 0;

        if ($flag != 1) {

            echo "Value Inserted into DB --> " . $dateTime . " " . $zone . " " . $din . " " . $status . " " . $str1 . " " . $spd1 . " " . $rt1 . " ";
            $sql = mysqli_query($conn, "INSERT INTO `$table_name`(`meter_id`,`parameter_name`,`value`,`DateTime`) VALUES ('$str_id','$str_parameterName','$str1','$dateTime'),('$spd_id','$spd_parameterName','$spd1','$dateTime'), ('$rt_id','$rt_parameterName','$rt1','$dateTime')");
        }
    }
}
$url1=$_SERVER['REQUEST_URI'];
header("Refresh: 0.5; URL=$url1");
?>
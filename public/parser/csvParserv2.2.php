<?php
$conn = new mysqli("localhost", "idp", "pass", "bm");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$noOfMeters= 8;
$file_name = "multi_test.csv";
$table_name = "data3";
ob_start();
date_default_timezone_set('Asia/Kolkata');
set_time_limit(0);
$fileHandler = file($file_name);
for($i=2;$i<sizeof($fileHandler);$i++)
{
    $sql = "SELECT * FROM '".$table_name."' ORDER BY DateTime DESC LIMIT 1";
    $result = $conn->query($sql);
    $dateTimeFromDB = "00-00-00 00:00:00";
    if($result) {
        while ($row = $result->fetch_array(MYSQL_ASSOC)) {
            $dateTimeFromDB = $row["DateTime"];
        }
    }
    $fileHandler = file($file_name);
    $lastLine = $fileHandler[$i];
    $data = str_getcsv($lastLine);
    $dateTime = $data[0] . " " . $data[1];
    if(strtotime($dateTime)>strtotime($dateTimeFromDB))
    {
        $zone = $data[2];
        $din = $data[3];
        $status = $data[4];
        for($j=0,$k=0;$j<$noOfMeters;$j++,$k+=3)
        {
            $str1 = $data[5+$k];
            $spd1 = $data[6+$k];
            $rt1 = $data[7+$k];
            $str_id = 9+$k;
            $spd_id = 10+$k;
            $rt_id = 11+$k;
            $str_parameterName = "str" . ($j+1) ;
            $spd_parameterName = "spd" . ($j+1) ;
            $rt_parameterName = "rt" . ($j+1) ;
            $sql = mysqli_query($conn, "INSERT INTO `$table_name`(`meter_id`,`parameter_name`,`value`,`DateTime`) VALUES ('$str_id','$str_parameterName','$str1','$dateTime'),('$spd_id','$spd_parameterName','$spd1','$dateTime'), ('$rt_id','$rt_parameterName','$rt1','$dateTime')");
        }
    }
}
ob_end_clean();
header("Location: csvParser.php");
die();
ob_end_flush();
?>
<?php

$conn = new mysqli("localhost", "idp", "pass", "bm");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$f=0;
date_default_timezone_set('Asia/Kolkata');
set_time_limit(0);
while($f==0) {
	$randomDataForkWH = rand(0, 1000);
    $randomDataForAmpere = rand(0, 250);
    $randomDataForCelcius = rand(0, 150);
    $randomDataForbar = rand(0, 10);
    $date = date("m-d-Y H:i:s");
    echo " Values added - kWH - " .$randomDataForkWH. " Ampere - " .$randomDataForAmpere. " Celcius " . $randomDataForCelcius . " bar - " . $randomDataForbar ."<br>";
    $sql = mysqli_query($conn, "INSERT INTO `testdata2`(`kWH`, `ampere`, `degreeC`, `bar`) VALUES ('$randomDataForkWH','$randomDataForAmpere','$randomDataForCelcius','$randomDataForbar')");

    usleep(10000000);

}
//$date = date("m-d-Y H:i:s");
//$randomData = rand(0, 1000);
//$sql = mysqli_query($conn, "INSERT INTO `testdata`(`dateTime`, `kWH`) VALUES ('$date','$randomData')");
//echo " Values added - ".$date." ".$randomData."<br>";

?>

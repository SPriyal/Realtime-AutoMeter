<?php
$conn = new mysqli("localhost", "idp", "pass", "bm");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$noOfMeters = 8;
$file_name = "multi_test.csv";
$table_name = "data";
$companyName = "N2P2 Pvt. Ltd.";
$csvFilePath = $companyName . "/";
date_default_timezone_set('Asia/Kolkata');
set_time_limit(0);
$fileHandler = file($file_name);
$lastLine = $fileHandler[sizeof($fileHandler) - 1];
$data = str_getcsv($lastLine);
if(validateDate($data[0])) {
    echo "<br/>=====True====<br/>";
//    $data[0] = date("Y-m-d", strtotime($data[0]));
    $dateInSeparateFormats = date_parse_from_format("d/m/y",$data[0]);
    $dateInYmd = $dateInSeparateFormats['year']."-".$dateInSeparateFormats['month']."-".$dateInSeparateFormats['day'];
    $data[0] = date("Y-m-d", strtotime($dateInYmd));
    $dateTime = $data[0] . " " . $data[1];
    $zone = $data[2];
    $din = $data[3];
    $status = $data[4];
    $currentDateTime = date("Y-m-d H:i:s");
    $currentDateTime_Less = date("Y-m-d H:i:s", strtotime($currentDateTime) - 3);
    $currentDateTime_More = date("Y-m-d H:i:s", strtotime($currentDateTime) + 3);
//    echo "<br><br><br><h2>Parsing for 'Column" . ($j + 1) . "' is under Progress...</h2>";
    if (strtotime($dateTime) < strtotime($currentDateTime_More) && strtotime($dateTime) > strtotime($currentDateTime_Less)) {
        for ($j = 0; $j < sizeof($data); $j++) {
            $currentColumnNo = $j;
            $sqlForFetchingMeterID = "SELECT id FROM `companies` WHERE columnNoInCSV=" . ($currentColumnNo + 1) . " AND csvFilePath='" . $csvFilePath . "'";
            //            echo "<br/><br/>sql query for meter is - :".$sqlForFetchingMeterID.": ...";
            $resultForMeterId = $conn->query($sqlForFetchingMeterID);
            if ($resultForMeterId) {
                //                echo "<br/>";
                //                echo "<br/>";
                //                echo "Enter in IF of meterFetchingSql";
                while ($rowForMeterId = $resultForMeterId->fetch_array(MYSQL_ASSOC)) {
                    $idOfCurrentColumnMeter = $rowForMeterId["id"];
                    $sql = "SELECT * FROM " . $table_name . " where DateTime = " . "'" . $dateTime . "' AND meter_id = " . "'" . $idOfCurrentColumnMeter . "'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0)
                        $flag = 1;
                    else
                        $flag = 0;

                    if ($flag != 1) {
                        //                    echo "<br/>";
                        //                    echo "meter id of current column is - :".$idOfCurrentColumnMeter.": ...";
                        $valueOfCurrentColumnMeter = $data[$currentColumnNo];
                        //                    echo "<br/>";
                        //                    echo "value of current column is - :".$valueOfCurrentColumnMeter.": ...";
                        $sqlForFetchingParameterID = "SELECT parameter_id FROM `companies` WHERE id=" . $idOfCurrentColumnMeter;
                        $resultForParameterId = $conn->query($sqlForFetchingParameterID);
                        if ($resultForParameterId) {
                            //                        echo "<br/>";
                            //                        echo "<br/>";
                            //                        echo "Entered in IF of parameterFetchingSql";
                            while ($rowForParameterId = $resultForParameterId->fetch_array(MYSQL_ASSOC)) {
                                $parameter_idOfCurrentMeter = $rowForParameterId["parameter_id"];
                                echo "<br/>";
                                //                            echo "parameter of current column is - :".$parameter_idOfCurrentMeter.": ...";
                                echo "Value Inserted into DB --> DateTime - " . $dateTime . " Zone -  " . $zone . " din - " . $din . "  status - " . $status . " meterId - " . $idOfCurrentColumnMeter . " valueInserted - " . $valueOfCurrentColumnMeter;
                                $sql = mysqli_query($conn, "INSERT INTO `$table_name`(`meter_id`,`parameter_id`,`value`,`DateTime`) VALUES ('$idOfCurrentColumnMeter','$parameter_idOfCurrentMeter','$data[$currentColumnNo]','$dateTime')");
                                //                            echo "<br/>";
                                //                            echo "<br/>";
                                //                            echo "Value inserted successfully!";
                            }
                        }
                    }
                }
            }
        }
    }
}
else{
    echo "<br/>=====False====<br/>";
}
function validateDate($date)
{
    $d = DateTime::createFromFormat('d/m/y', $date);
    return $d && $d->format('d/m/y') === $date;
}
$url1 = $_SERVER['REQUEST_URI'];
header("Refresh: 0.5; URL=$url1");
?>
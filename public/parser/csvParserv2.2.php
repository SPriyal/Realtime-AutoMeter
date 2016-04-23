<?php
$conn = new mysqli("localhost", "idp", "pass", "bm");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$noOfMeters= 8;
$file_name = "multi_test.csv";
$table_name = "data";
$companyName = "N2P2 Pvt. Ltd.";
$csvFilePath = $companyName."/";
ob_start();
date_default_timezone_set('Asia/Kolkata');
set_time_limit(0);
$fileHandler = file($file_name);
for($i=0;$i<sizeof($fileHandler);$i++)
{
//    $sql = "SELECT * FROM '".$table_name."' ORDER BY DateTime DESC LIMIT 1";
//    $result = $conn->query($sql);
//    $dateTimeFromDB = "00-00-00 00:00:00";
//    if($result) {
//        while ($row = $result->fetch_array(MYSQL_ASSOC)) {
//            $dateTimeFromDB = $row["DateTime"];
//        }
//    }
    $fileHandler = file($file_name);
    $lastLine = $fileHandler[$i];
    $data = str_getcsv($lastLine);
    if(validateDate($data[0])) {
//        echo "<br/>=====True====<br/>";
//        $data[0] = date("Y-m-d", strtotime($data[0]));
        $dateInSeparateFormats = date_parse_from_format("d/m/y",$data[0]);
        $dateInYmd = $dateInSeparateFormats['year']."-".$dateInSeparateFormats['month']."-".$dateInSeparateFormats['day'];
        $data[0] = date("Y-m-d", strtotime($dateInYmd));
        $dateTime = $data[0] . " " . $data[1];
//    echo $dateTime . " It was obtained by combining these two.. \t " . $data[0] . " & " .$data[1];
//    if(strtotime($dateTime)>strtotime($dateTimeFromDB))
        {
            $zone = $data[2];
            $din = $data[3];
            $status = $data[4];
            for ($j = 0; $j < sizeof($data); $j++) {
//            echo "<br><br>----------------------------------------------------------------------------------------------------------------------------------------------------------<br>";
//            echo "".$j . " no of meters ". sizeof($data);
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
//                    echo "<br/>";
//                    echo "meter id of current column is - :".$idOfCurrentColumnMeter.": ...";
                        $sqlForCheckingIfEntryExistsInDb = "SELECT * FROM " . $table_name . " where DateTime = " . "'" . $dateTime . "' AND meter_id = " . "'" . $idOfCurrentColumnMeter . "'";
                        $resultForCheckingIfEntryExistsInDb = mysqli_query($conn, $sqlForCheckingIfEntryExistsInDb);
                        if (!(mysqli_num_rows($resultForCheckingIfEntryExistsInDb) > 0)) {
//                        echo "<br/>";
//                        echo "Entered in Check of if entry already exists in DB!";
                            $valueOfCurrentColumnMeter = $data[$currentColumnNo];
//                        echo "<br/>";
//                        echo "value of current column is - :".$valueOfCurrentColumnMeter.": ...";
                            $sqlForFetchingParameterID = "SELECT parameter_id FROM `companies` WHERE id=" . $idOfCurrentColumnMeter;
                            $resultForParameterId = $conn->query($sqlForFetchingParameterID);
                            if ($resultForParameterId) {
//                            echo "<br/>";
//                            echo "<br/>";
//                            echo "Entered in IF of parameterFetchingSql";
                                while ($rowForParameterId = $resultForParameterId->fetch_array(MYSQL_ASSOC)) {
                                    $parameter_idOfCurrentMeter = $rowForParameterId["parameter_id"];
//                                echo "<br/>";
//                                echo "parameter of current column is - :".$parameter_idOfCurrentMeter.": ...";
                                    $sql = mysqli_query($conn, "INSERT INTO `$table_name`(`meter_id`,`parameter_id`,`value`,`DateTime`) VALUES ('$idOfCurrentColumnMeter','$parameter_idOfCurrentMeter','$data[$currentColumnNo]','$dateTime')");
//                                echo "<br/>";
//                                echo "<br/>";
//                                echo "Value inserted successfully!";
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    else{
//        echo "<br/>=====False====<br/>";
    }
}
function validateDate($date)
{
    $d = DateTime::createFromFormat('d/m/y', $date);
    return $d && $d->format('d/m/y') === $date;
}

ob_end_clean();
header("Location: csvParserv2.2Live.php");
die();
ob_end_flush();
?>
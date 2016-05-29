<?php
$conn = new mysqli("localhost", "idp", "pass", "bm");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$noOfMeters= 8;



//=================Downloading file from FTP Connection BELOW=========================
$ftp_server = "ftp.milltech.in";
$ftp_conn = ftp_connect($ftp_server, '21','5') or die("Could not connect to $ftp_server");
$ftp_username = "Clients@milltech.in";
$ftp_userpass = "clients123pwd";
$login = ftp_login($ftp_conn, $ftp_username, $ftp_userpass);
$server_file = "AutoSoft/nrn28/stenter/".date("Ymd").".csv";
$local_file = date("Ymd").".csv";
$fp = fopen($local_file, "w");
if (ftp_fget($ftp_conn, $fp, $server_file, FTP_ASCII, 0))
{
    echo "Successfully written to $local_file.";
}
else
{
    echo "Error downloading $server_file.";
}
//=================Downloading file from FTP Connection FINISH=========================





$file_name = $local_file;
$table_name = "data";
$companyName = "N2P2 Pvt. Ltd.";
$csvFilePath = $companyName."/";
date_default_timezone_set('Asia/Kolkata');
set_time_limit(0);
$fileHandler = file($file_name);
//$whileLoopCounter = 0;
//while(true) {
//    echo "<br/>While Loop ". $whileLoopCounter;
$sizeOfFileHander = sizeof($fileHandler);
if($sizeOfFileHander > 10 ) {
    echo "<br/> size is greater than 10";
    mainParser($conn, $fileHandler, 10, $table_name, $csvFilePath);
}
else {
    echo "<br/> size is smaller than 10";
    mainParser($conn, $fileHandler, $sizeOfFileHander, $table_name, $csvFilePath);
}
//    $whileLoopCounter++;
//}

function mainParser($conn,$fileHandler,$noOfTimesLoopRuns,$table_name,$csvFilePath){
    for ($i = sizeof($fileHandler) - $noOfTimesLoopRuns; $i < sizeof($fileHandler); $i++) {
//    $sql = "SELECT * FROM '".$table_name."' ORDER BY DateTime DESC LIMIT 1";
//    $result = $conn->query($sql);
//    $dateTimeFromDB = "00-00-00 00:00:00";
//    if($result) {
//        while ($row = $result->fetch_array(MYSQL_ASSOC)) {
//            $dateTimeFromDB = $row["DateTime"];
//        }
//    }

        $lastLine = $fileHandler[$i];
        $data = str_getcsv($lastLine);
        if (validateDate($data[0])) {
//        echo "<br/>=====True====<br/>";
//        $data[0] = date("Y-m-d", strtotime($data[0]));
            $dateInSeparateFormats = date_parse_from_format("d/m/y", $data[0]);
            $dateInYmd = $dateInSeparateFormats['year'] . "-" . $dateInSeparateFormats['month'] . "-" . $dateInSeparateFormats['day'];
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
//            echo "".$j . " no of meters ". sizeof($data) . "====================Main Loop Iteration : .$i===================";
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
                                        echo "<br/>";
//                                echo "<br/>";
//                                echo "<br/>Value inserted successfully!";
//                                        echo "Value Inserted into DB --> DateTime - " . $dateTime . " Zone -  " . $zone . " din - " . $din . "  status - " . $status . " meterId - " . $idOfCurrentColumnMeter . " valueInserted - " . $valueOfCurrentColumnMeter;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        } else {
            echo "<br/>=====False====<br/>";
        }
    }
}

function validateDate($date)
{
    $d = DateTime::createFromFormat('d/m/y', $date);
    return $d && $d->format('d/m/y') === $date;
}

//ob_end_clean();
//header("Location: csvParser.php");
//die();
//ob_end_flush();
ftp_close($ftp_conn);
$url1 = $_SERVER['REQUEST_URI'];
header("Refresh: 7; URL=$url1");
?>
<?php
echo "<html><body><table border=\"1\">\n\n";
$i=0;
$fileHandler = fopen("multi_test.csv", "r");
while (($line = fgetcsv($fileHandler)) !== false) {
    echo "<tr>";
    echo "<td>" .$i++ . "</td>";
    foreach ($line as $cell) {
        echo "<td>" . htmlspecialchars($cell) . "</td>";
    }
    echo "</tr>\n";
}
fclose($fileHandler);
echo "\n</table></body></html>";
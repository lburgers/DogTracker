<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // php script for updating latLong.txt from the tracker itself
    $cordinates = $_GET['latLong']; //get coordinates from url
    if (empty($cordinates)) {
        echo "Name is empty";
    } else {
	$file = fopen("latLong.txt", "w") or error_log("Unable to open");
	fwrite($file, $cordinates); //write these coordinates to latLong.txt
        fclose($file);
    }
}
?>

<?php
$pw = 'test';
$filename = 'stats.txt';


$kills = $_GET['kills'];
$deaths = $_GET['deaths'];
$date = $_GET['date'];

if (is_writable($filename) && $pw == $_GET['pw']) {
	if (!$handle = fopen($filename, "a")) {
        exit;
    }

    if (!fwrite($handle, $date.",".$kills.",".$deaths."\n")) {
        print "Kann in die Datei $filename nicht schreiben";
        exit;
    }
    fclose($handle);
}

?>
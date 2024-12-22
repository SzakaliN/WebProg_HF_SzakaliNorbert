<?php
$napok = array(
    "HU" => array("H", "K", "Sze", "Cs", "P", "Szo", "V"),
    "EN" => array("M", "Tu", "W", "Th", "F", "Sa", "Su"),
    "DE" => array("Mo", "Di", "Mi", "Do", "F", "Sa", "So"),
);

foreach ($napok as $nyelv => $napokNev) {
    $i = 1;
    echo "$nyelv: ";
    foreach ($napokNev as $nap) {
        if ($i % 2 == 0) {
            echo "<b>$nap</b>, ";
        } else {
            echo "$nap, ";
        }
        $i += 1;
    }
    echo "<br>";
}
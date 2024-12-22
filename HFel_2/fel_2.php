<?php
$orszagok = array(
    "Magyarország" => "Budapest",
    "Románia" => "Bukarest",
    "Belgium" => "Brussels",
    "Austria" => "Vienna",
    "Poland" => "Warsaw"
);


foreach ($orszagok as $orszag => $varos) {
    echo  $orszag . ' fővárosa <span style="color: red">'.$varos.'</span><br>';
}

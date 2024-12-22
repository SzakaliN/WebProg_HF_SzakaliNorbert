<?php
$array = [5, '5', '05', 12.3, '16.7', 'five', 'true', 0xDECAFBAD, '10e200'];

foreach ($array as $elem) {
    $type = gettype($elem);
    $isNumeric = is_numeric($elem);

    if ($isNumeric) {
        echo $elem.": $type: Igen<br>";
    } else {
        echo $elem.": $type: Nem<br>";
    }
}

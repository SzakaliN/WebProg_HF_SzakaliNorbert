<?php
$a = 8;
$b = 3;

echo "A számok: $a és $b<br>";
$osszead = $a + $b;
echo "Az összeadás eredménye: $a + $b = $osszead<br>";

$kivon = $a - $b;
echo "A kivonás eredménye: $a - $b = $kivon<br>";

$szorz = $a * $b;
echo "A szorzás eredménye: $a * $b = $szorz<br>";

if ($b != 0) {
    $oszt = $a / $b;
    echo "Az osztás eredménye: $a / $b = $oszt<br>";
} else {
    echo "Nullával nem lehet osztani.<br>";
}

$hatvany = pow($a, $b);
echo "A hatványozás eredménye: $a ^ $b = $hatvany<br>";
<?php
$mp = 6894; $mp_fix = $mp;
if (is_int($mp)) {
    $p = $mp % 60;
    $mp = floor($mp / 60);
    $h = floor($mp / 60);
    $mp = $mp % 60;
    echo "$mp_fix másodperc az  $h óra $mp perc";
} else {
    echo "Ez nem egész szám!";
}
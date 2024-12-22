<?php
$szinek = array(
    'A' => 'Kek',
    'B' => 'Zold',
    'c' => 'Piros'
);

function lovering($tomb) {
    return array_map('strtolower', $tomb);
}

function uppering($tomb) {
    return array_map('strtoupper', $tomb);

}

print "Kisbetűs:<br>";
$kisbetu = lovering($szinek);
print implode('<br>', $kisbetu);
print '<br>';

print "<br>Nagybetűs:<br>";
$nagybetu = uppering($szinek);
print implode('<br>', $nagybetu);
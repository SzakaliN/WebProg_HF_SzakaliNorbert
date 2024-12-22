<?php
$honap = 5;

if ($honap >= 3 && $honap <= 5) {
    $evszak = "Tavasz";
} elseif ($honap >= 6 && $honap <= 8) {
    $evszak = "Nyár";
} elseif ($honap >= 9 && $honap <= 11) {
    $evszak = "Ősz";
} else {
    $evszak = "Tél";
}

echo "A $honap. hónap a(z) $evszak egyik hónapja.<br>";
?>
<?php
$honap = 10;

switch ($honap) {
    case 3:
    case 4:
    case 5:
        $evszak = "Tavasz";
        break;
    case 6:
    case 7:
    case 8:
        $evszak = "Nyár";
        break;
    case 9:
    case 10:
    case 11:
        $evszak = "Ősz";
        break;
    case 12:
    case 1:
    case 2:
        $evszak = "Tél";
        break;
    default:
        $evszak = "Érvénytelen hónap";
        break;
}

echo "A $honap. hónap a(z) $evszak egyik hónapja.";
?>
<?php
session_start();

if (isset($_POST['elkuldott']) && $_POST['elkuldott'] == 'true') {

    if (!isset($_COOKIE['szerverOldaliSzam'])) {
        $szerverOldaliSzam = rand(1, 10);
        setcookie('szerverOldaliSzam', $szerverOldaliSzam, time() + 3600);
    } else {
        $szerverOldaliSzam = $_COOKIE['szerverOldaliSzam'];
    }

    $felhasznaloTalalgatas = intval($_POST['talalgatas']);

    if ($felhasznaloTalalgatas < $szerverOldaliSzam) {
        $uzenet = "A szám nagyobb. <br>";
    } elseif ($felhasznaloTalalgatas > $szerverOldaliSzam) {
        $uzenet = "A szám kisebb. <br>";
    } else {
        $uzenet = "Gratulálunk! Eltaláltad a számot: $szerverOldaliSzam <br>";
        setcookie('szerverOldaliSzam', '', time() - 3600);
    }

    echo $uzenet;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Találgatós játék</title>
</head>
<body>
<form method="POST" action="">
    <input type="hidden" name="elkuldott" value="true">
    Melyik számra gondoltam 1 és 10 között?
    <input name="talalgatas" type="text">
    <br>
    <br>
    <input type="submit" value="Elküld">
</form>
</body>
</html>

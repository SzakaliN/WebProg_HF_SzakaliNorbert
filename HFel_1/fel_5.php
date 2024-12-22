<?php
$a = 20;
$b = 4;
$tomb = array('+', '-', '*', '/');
$tomb = $tomb[rand(0, 3)];

if (is_numeric($a) and is_numeric($b)) {
    switch ($tomb) {
        case '+':
            $eredmeny = $a + $b;
            echo "$a + $b = ".  $eredmeny;
            break;
        case '-':
            $eredmeny = $a - $b;
            echo "$a - $b = ".  $eredmeny;
            break;
        case '*':
            $eredmeny = $a * $b;
            echo "$a * $b = ".  $eredmeny;
            break;
        case '/':
            if ($b != 0) {
                $eredmeny = $a * $b;
                echo "$a * $b = " . $eredmeny;
                break;
            } else {
                echo "Nem oszthato nullaval";
            }

    }
}else {
    echo "Nem szam";
}
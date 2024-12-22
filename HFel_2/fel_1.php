<?php
echo "<table border='1' cellpadding='5'>";
$n = 10;
for ($row = 1; $row <= $n; $row++) {
    echo "<tr>";
    for ($col = 1; $col <= $n; $col++) {
        if ($row == $col) {
            $color = 'cyan';
        } else {
            $color = 'white';
        }
        echo "<td style='background-color: $color; width: 20px; height: 30px;'>".$row * $col."</td>";
    }
    echo "</tr>";
}
echo "</table>";
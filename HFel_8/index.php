<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

include 'db/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add'])) {
        $name = $_POST['name'];
        $course = $_POST['course'];
        $average = $_POST['average'];

        if (!empty($name) && !empty($course) && !empty($average)) {
            $count_query = "SELECT COUNT(*) AS count FROM hallgatok";
            $count_result = $conn->query($count_query);
            $row = $count_result->fetch_assoc();
            $count = $row['count'];

            $id = $count + 1;

            $sql = "INSERT INTO hallgatok (id, name, course, average) VALUES ('$id', '$name', '$course', '$average')";

            if ($conn->query($sql) === TRUE) {
                echo "Új hallgató sikeresen hozzáadva.";
                header('Location: ' . $_SERVER['PHP_SELF']);
                exit();
            } else {
                echo "Hiba: " . $sql . "<br>" . $conn->error;
            }
        }
    } elseif (isset($_POST['update'])) {
        if (isset($_POST['name']) && is_array($_POST['name'])) {
            foreach ($_POST['name'] as $id => $name) {
                $course = $_POST['course'][$id];
                $average = $_POST['average'][$id];

                if (!empty($name) && !empty($course) && !empty($average)) {
                    // SQL lekérdezés a hallgató adatainak frissítésére
                    $sql = "UPDATE hallgatok SET name='$name', course='$course', average='$average' WHERE id=$id";

                    if ($conn->query($sql) !== TRUE) {
                        echo "Hiba a frissítés közben: " . $conn->error;
                    }
                } else {
                    echo "Hiányzó vagy üres adatok. Kérlek töltsd ki minden mezőt.";
                }
            }
        } else {
            echo "Hiba az adatokban vagy a formátumban!";
        }
    } elseif (isset($_POST['delete'])) {
        $id = $_POST['delete']; // Az aktuális hallgató azonosítója

        $sql = "DELETE FROM hallgatok WHERE id=$id"; // Hallgató törlése azonosító alapján

        if ($conn->query($sql) === TRUE) {
            echo "Hallgató törölve.";

            // Újraszámozás és az id-k újradefiniálása
            $sqlUpdateIds = "SET @counter = 0; UPDATE hallgatok SET hallgatok.id = @counter := @counter + 1;";
            if ($conn->multi_query($sqlUpdateIds)) {
                do {
                    if ($result = $conn->store_result()) {
                        $result->free();
                    }
                } while ($conn->next_result());
            } else {
                echo "Hiba az újraszámozás során: " . $conn->error;
            }

            header('Location: ' . $_SERVER['PHP_SELF']);
            exit();
        } else {
            echo "Hiba: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Ellenőrizzük, hogy ha van adat, akkor azok megjelenjenek
$sql = "SELECT * FROM hallgatok";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<form method='post'>";
    echo "<table border='1'>";
    echo "<thead><tr><th>ID</th><th>Name</th><th>Course</th><th>Average</th><th>Műveletek</th><th></th></tr></thead>";
    echo "<tbody>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td><input type='text' name='name[" . $row["id"] . "]' value='" . $row["name"] . "'></td>";
        echo "<td><input type='text' name='course[" . $row["id"] . "]' value='" . $row["course"] . "'></td>";
        echo "<td><input type='text' name='average[" . $row["id"] . "]' value='" . $row["average"] . "'></td>";
        echo "<td>
                <button type='submit' name='delete' value='" . $row["id"] . "'>Törlés</button>
              </td>";
        echo "<td>
                <button type='submit' name='update' value='" . $row["id"] . "'>Frissítés</button>
              </td>";
        echo "</tr>";
    }
    echo "</tbody></table>";
    echo "</form>";
} else {
    echo "0 results";
}

$conn->close();
?>

<div class="forms">
    <h2>Új Hallgató Hozzáadása</h2>
    <form action="" method="post">
        Név:<br>
        <input type="text" name="name"><br><br>
        Szak:<br>
        <input type="text" name="course"><br><br>
        Átlag:<br>
        <input type="text" name="average"><br><br>
        <input type="submit" name="add" value="Hozzáadás">
    </form>
</div>

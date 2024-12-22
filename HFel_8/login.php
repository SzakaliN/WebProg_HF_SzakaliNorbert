<?php
session_start();
include 'db/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT username, password FROM felhasznalok WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $_SESSION['username'] = $username; // Sikeres bejelentkezés, munkamenet változó beállítása
        header('Location: index.php'); // Átirányítás az index.php oldalra
        exit();
    } else {
        $error = "Hibás felhasználónév vagy jelszó!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Bejelentkezés</title>
</head>
<body>
<h2>Bejelentkezés</h2>
<form action="" method="post">
    Felhasználónév: <input type="text" name="username"><br><br>
    Jelszó: <input type="password" name="password"><br><br>
    <input type="submit" value="Bejelentkezés">
</form>
<?php if (isset($error)) { echo $error; } ?>
</body>
</html>

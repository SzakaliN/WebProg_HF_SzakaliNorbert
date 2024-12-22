<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "egyetem";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
} else {
    echo "Connection successful";
}

// adatkötést a lekérdezéshez
$stmt = $conn->prepare("SELECT id, name, course, average FROM hallgatok");
$stmt->execute();
$result = $stmt->get_result();
?>
<?php

$servername = "webpagesdb.it.auth.gr:3306";
$username = "dimitra2";
$password = "12345";
$dbname = "pythonwebsite";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $announcement_id = $_GET['id'];


    $sql = "DELETE FROM course_announcements WHERE announcement_id = $announcement_id";

    if ($conn->query($sql) === TRUE) {
        header("Location: announcement.php");
        exit();
    } else {
        echo "Error deleting announcement: " . $conn->error;
    }
}

$conn->close();
?>

<?php
session_start();
$servername = "webpagesdb.it.auth.gr:3306";
$username = "dimitra2";
$password = "12345";
$dbname = "pythonwebsite";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sender = $_POST['sender'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];


    $sql = "SELECT username FROM users WHERE role = 'Tutor'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $to = $row['username'];
            echo "Sending email to: $to <br>"; // Print the username
            $headers = "From: $sender";
            mail($to, $subject, $message, $headers);

        }
    } else {
        echo "No tutors found.";
    }
}
?>

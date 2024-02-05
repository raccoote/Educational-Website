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

$username = $_POST['username'];
$password = $_POST['password'];

$username = mysqli_real_escape_string($conn, $username);
$password = mysqli_real_escape_string($conn, $password);


$sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $user_data = $result->fetch_assoc();
    $user_role = $user_data['role'];

    $_SESSION['user_role'] = $user_role;


    header("Location: index.html");
} else {

    header("Location: login.html");
}

$conn->close();
?>

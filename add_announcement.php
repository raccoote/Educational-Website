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

    $new_subject = $_POST['subject'];
    $new_date = $_POST['date'];
    $new_content = $_POST['content'];


    $sql = "INSERT INTO course_announcements (announcement_subject, announcement_date, announcement_content) VALUES ('$new_subject', '$new_date', '$new_content')";

    if ($conn->query($sql) === TRUE) {
        header("Location: announcement.php");
        exit;
    } else {
        echo "Error adding announcement: " . $conn->error;
    }
}


$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Announcement - PythonPawPals</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div id="top"></div>
    <header>
        <h1>Add Announcement</h1>
    </header>

    <main>
        <nav>
            <ul>
                <li><a href="index.html">Αρχική Σελίδα</a></li>
                <li><a href="announcement.php">Ανακοινώσεις</a></li>
                <li><a href="communication.html">Επικοινωνία</a></li>
                <li><a href="documents.php">Έγγραφα Μαθήματος</a></li>
                <li><a href="homework.php">Εργασίες</a></li>
                <li><a href="login.html">Αποσύνδεση</a></li>
            </ul>
        </nav>

    <div class="content">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

            <label for="subject">Θέμα:</label>
            <input type="text" id="subject" name="subject"><br><br>


            <label for="date">Ημερομηνία:</label>
            <input type="date" id="date" name="date"><br><br>

            <label for="content">Περιεχόμενο:</label><br>
            <textarea id="content" name="content" rows="4" cols="50"></textarea><br><br>

            <input type="submit" value="Ανάρτηση ανακοίνωσης">
        </form>
    </div>
</body>
</html>

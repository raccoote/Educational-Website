<?php
session_start(); 
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: announcement.php"); 
    exit();
}

$servername = "webpagesdb.it.auth.gr:3306";
$username = "dimitra2";
$password = "12345";
$dbname = "pythonwebsite";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$announcement_id = $_GET['id']; 

if (isset($_GET['id'])) {
    $announcement_id = $_GET['id'];


    $sql = "SELECT * FROM course_announcements WHERE announcement_id = $announcement_id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {

        $row = $result->fetch_assoc();
        $announcement_subject = $row['announcement_subject'];
        $announcement_date = $row['announcement_date'];
        $announcement_content = $row['announcement_content'];
    } else {
        echo "Announcement not found.";
    }
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $new_subject = $_POST['subject'];
    $new_date = $_POST['date'];
    $new_content = $_POST['content'];

    $sql = "UPDATE course_announcements SET announcement_subject='$new_subject', announcement_date='$new_date', announcement_content='$new_content' WHERE announcement_id=$announcement_id";

    if ($conn->query($sql) === TRUE) {
        header("Location: announcement.php");
	exit;
    } else {
        echo "Error updating announcement: " . $conn->error;
    }
}


$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Announcement - PythonPawPals</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div id="top"></div>
    <header>
        <h1>Edit Announcement</h1>
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
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $announcement_id; ?>" method="POST">

        <label for="subject">Θέμα:</label>
        <input type="text" id="subject" name="subject" value="<?php echo $announcement_subject; ?>"><br><br>


        <label for="date">Ημερομηνία:</label>
        <input type="date" id="date" name="date" value="<?php echo $announcement_date; ?>"><br><br>


        <label for="content">Περιεχόμενο:</label><br>
        <textarea id="content" name="content" rows="4" cols="50"><?php echo $announcement_content; ?></textarea><br><br>

        <input type="submit" value="Save Changes">
    </form>
</div>

    </main>
</body>
</html>

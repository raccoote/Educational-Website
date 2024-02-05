<?php
$servername = "webpagesdb.it.auth.gr:3306";
$username = "dimitra2";
$password = "12345";
$dbname = "pythonwebsite";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $new_objectives = $_POST['objectives'];
    $new_file_name = $_POST['file_name'];
    $new_deliverables = $_POST['deliverables'];
    $new_submission_date = $_POST['submission_date'];
    $sql = "INSERT INTO course_assignments (objectives, file_name, deliverables, submission_date) VALUES ('$new_objectives', '$new_file_name', '$new_deliverables', '$new_submission_date')";
    
if ($conn->query($sql) === TRUE) {
    $announcement_date = date("Y-m-d");

    $query_last_assignment = "SELECT MAX(assignment_id) AS last_assignment_id FROM course_assignments";
    if ($result = $conn->query($query_last_assignment)) {
        $row = $result->fetch_assoc();
        $announcement_subject = "Υποβλήθηκε η εργασία " . $row['last_assignment_id'];
        $announcement_content = "Η ημερομηνία παράδοσης της εργασίας είναι $new_submission_date";

        $sql_announcement = "INSERT INTO course_announcements (announcement_subject, announcement_date, announcement_content) VALUES ('$announcement_subject', '$announcement_date', '$announcement_content')";

        if ($conn->query($sql_announcement) === TRUE) {
            header("Location: homework.php");
            exit;
        } else {
            echo "Error adding announcement: " . $conn->error;
        }
    } else {
        echo "Error fetching last assignment ID: " . $conn->error;
    }
} else {
    echo "Error adding assignment: " . $conn->error;
}
}


$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Assignment - PythonPawPals</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div id="top"></div>
    <header>
        <h1>Add Assignment</h1>
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
   
                <label for="objectives">Στόχοι εργασίας:</label><br>
                <textarea id="objectives" name="objectives" rows="4" cols="50"></textarea><br><br>

    
                <label for="file_name">Όνομα αρχείου:</label>
                <input type="text" id="file_name" name="file_name"><br><br>


                <label for="deliverables">Παραδοτέα:</label><br>
                <textarea id="deliverables" name="deliverables" rows="4" cols="50"></textarea><br><br>

                <label for="submission_date">Ημερομηνία παράδοσης:</label>
                <input type="date" id="submission_date" name="submission_date"><br><br>

                <input type="submit" value="Προσθήκη εργασίας">
            </form>
        </div>
    </main>
</body>
</html>

<?php
session_start(); // Start the session

$servername = "webpagesdb.it.auth.gr:3306";
$username = "dimitra2";
$password = "12345";
$dbname = "pythonwebsite";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_title = $_POST['title'];
    $new_description = $_POST['description'];
    $new_file_name_position = $_POST['file_name_position'];


    $sql = "INSERT INTO course_documents (document_title, document_description, file_name_position) VALUES ('$new_title', '$new_description', '$new_file_name_position')";

    if ($conn->query($sql) === TRUE) {
        header("Location: documents.php");
        exit;
    } else {
        echo "Error adding document: " . $conn->error;
    }
}


$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Document - PythonPawPals</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div id="top"></div>
    <header>
        <h1>Add Document</h1>
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
 
                <label for="title">Τίτλος εγγράφου:</label>
                <input type="text" id="title" name="title"><br><br>


                <label for="description">Περιγραφή εγγράφου:</label><br>
                <textarea id="description" name="description" rows="4" cols="50"></textarea><br><br>

                <label for="file_name_position">Όνομα αρχείου/θέση:</label>
                <input type="text" id="file_name_position" name="file_name_position"><br><br>

                <input type="submit" value="Προσθήκη εγγράφου">
            </form>
        </div>
    </main>
</body>
</html>

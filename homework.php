


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



$sql = "SELECT * FROM course_assignments";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Εργασίες PythonPawPals</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <a name="top"></a>
    <header>
        <h1>Εργασίες</h1>
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
	<?php
	    $user_role = $_SESSION['user_role'];
	    if ($user_role === 'Tutor') {
                 echo '<a href="add_homework.php">Προσθήκη νέας Εργασίας</a><br><br>';
            }
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="announcement">';
        echo '<h2 class="announcement-title">' . $row['assignment_id'] . 'η Εργασία</h2>';
        echo '<p class="announcement-info"><strong>Στόχοι:</strong>Οι στόχοι της εργασίας είναι:</p>';
        

        $objectives_array = explode(',', $row['objectives']);


        echo '<ul class="announcement-info objectives-list">';

        foreach ($objectives_array as $objective) {
            echo '<li>' . $objective . '</li>';
        }
        echo '</ul>';

        echo '<p class="announcement-info"><strong>Εκφώνηση:</strong></p>';
        echo '<p class="announcement-info">Κατεβάστε την εκφώνηση της εργασίας από <a href="' . $row['file_name'] . '" style="color: blue;">εδώ</a></p>';
        
        echo '<p class="announcement-info"><strong>Παραδοτέα:</strong></p>';
        echo '<ul class="announcement-info objectives-list">';
        

        $deliverables_array = explode(',', $row['deliverables']);
        

        foreach ($deliverables_array as $deliverable) {
            echo '<li>' . $deliverable . '</li>';
        }
        
        echo '</ul>';
        echo '<p class="announcement-info"><strong>Ημερομηνία Παράδοσης:</strong> ' . $row['submission_date'] . '</p>';
        echo '</div>';
    }
}


            $conn->close();
            ?>
        </div>
    </main>
</body>
<a href="#top" style="position: fixed; bottom: 20px; right: 220px;">Go to Top</a>
</html>

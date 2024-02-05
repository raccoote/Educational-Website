<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Έγγραφα Μαθήματος PythonPawPals</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <a name="top"></a>
    <header>
        <h1>Έγγραφα Μαθήματος</h1>
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
            session_start();
            $servername = "webpagesdb.it.auth.gr:3306";
            $username = "dimitra2";
            $password = "12345";
            $dbname = "pythonwebsite";


            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

          
            $user_role = $_SESSION['user_role'];

            if ($user_role === 'Tutor') {
                echo '<a href="add_document.php">Προσθήκη νέου εγγράφου</a><br><br>';
            }

            $sql = "SELECT * FROM course_documents";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {
                    echo '<div class="announcement">';
                    echo '<h2 class="announcement-title">' . $row['document_title'] . '</h2>';
                    echo '<p class="announcement-info">';
                    echo '<strong>Περιγραφή:</strong> ' . $row['document_description'];
                    echo '<br><br><a href="' . $row['file_name_position'] . '" download>Download</a>';
                    echo '</p></div>';
                }
            } else {
                echo "0 results";
            }


            $conn->close();
            ?>
        </div>
    </main>
</body>
<a href="#top" style="position: fixed; bottom: 20px; right: 220px;">Go to Top</a>
</html>

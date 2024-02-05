<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ανακοινώσεις PythonPawPals</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <a name="top"></a>
    <header>
        <h1>Ανακοινώσεις</h1>
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
             $user_role =$_SESSION['user_role'];

            if ($user_role === 'Tutor') {
                echo '<a href="add_announcement.php">Προσθήκη νέας ανακοίνωσης</a><br><br>';
            }

            $sql = "SELECT * FROM course_announcements";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="announcement">';
                    echo '<h2 class="announcement-title">Ανακοίνωση ' . $row["announcement_id"];

                    if ($user_role === 'Tutor') {
                       echo '<span class="small-link"><a href="delete_announcement.php?id=' . $row["announcement_id"] . '">[διαγραφή]</a></span>';
                       echo '<span class="small-link"><a href="edit_announcement.php?id=' . $row["announcement_id"] . '">[επεξεργασία]</a></span>';
                    } 
                    
                    echo '</h2>';
                    echo '<p class="announcement-info">';
                    echo '<strong>Ημερομηνία:</strong> ' . $row["announcement_date"] . '<br>';
                    echo '<strong>Θέμα:</strong> ' . $row["announcement_subject"] . '<br><br>';
                    echo $row["announcement_content"];



                    echo '</p></div>';
                }
            } 
	    

            $conn->close();
            ?>
        </div>
    </main>
</body>
<a href="#top" style="position: fixed; bottom: 20px; right: 220px;">Go to Top</a>
</html>

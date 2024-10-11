Link to page: http://pazodimi.webpages.auth.gr/3902partB/

![image](https://github.com/raccoote/Educational-Website/assets/74006924/7a6081fd-2628-421a-a6f4-fd3ae9399c7c)


"PythonPawPals" is a dynamic website for learning and practicing Python, featuring resources, tools, and a navigation menu with five main sections. Tutors can log in with extra privileges, like posting, editing, and deleting announcements, assignments, and documents. Below are some credentials to test it out yourself:


![image](https://github.com/raccoote/Educational-Website/assets/74006924/a6942021-61f4-402e-9ccd-8ff1c383d3c8)

 
**Email Sending**

In the 'Contact' section, send_email.php checks if the request is POST, captures the form data (sender, subject, message), retrieves all users with the "Tutor" role via an SQL query, and sends an email using mail().


**Managing Announcements, Documents, and Homework**

The add_announcement.php handles POST requests to add announcements by saving form data to the database. Similar functionality exists for add_document.php and add_homework.php.

The edit_announcement.php retrieves the announcement using its id, fills the form with existing data, and updates it via SQL. The delete_announcement.php deletes announcements based on the id, redirecting users after success or showing an error on failure.


![image](https://github.com/raccoote/Educational-Website/assets/74006924/d109ad7b-43e2-4976-98b6-82b9d60fac17)


**Automatic Announcement for New Homework**


add_homework.php adds a new assignment and automatically posts an announcement to notify students. It inserts assignment data into the database, retrieves the last assignment_id, creates an announcement with the due date, and inserts it into the "course_announcements" table. If successful, it redirects the user to the homework page.

**A Glimpse at the Database**


The student3902.sql database organizes information for the smooth operation of the website. Here’s a brief overview of each table:


•	users: Stores user personal information and access rights. The role variable(Student/Tutor) is crucial as it determines permissions.

•	course_announcements: Records site announcements with a unique announcement_id, publication date, subject, and content.

•	course_documents: Represents course-related documents, including a unique document_id, title, description, and file name.

•	course_assignments: Represents tasks assigned to students, including a unique assignment_id, objectives, file name, deliverables, and submission date. This table helps organize and manage course assignments.

Each table contains 10 sample instances, specifically tailored for a Python learning website with educational content. For example, below we see the course_assignments table:


![image](https://github.com/raccoote/Educational-Website/assets/74006924/2aafde77-cc8f-4c9d-9d32-b583cc624a07)


Each PHP file starts with session_start() to initiate or resume a session. It then connects to a MySQL database using new mysqli with server details, username, password, and database name. If the connection fails, an error message is displayed. Initially, I developed the website on my personal computer using XAMPP, setting $servername = localhost.

![image](https://github.com/raccoote/Educational-Website/assets/74006924/ba1d5ee7-edf0-4e83-bc4e-4f2271c8d0c6)


<!-- delete.php -->

<?php require_once('../api/config.php'); ?> <!-- Include the configuration file that contains database connection details -->
<!doctype html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/Style.css"> <!-- Link to the general CSS file for styling -->
    <link rel="stylesheet" type="text/css" href="css/delete.css"> <!-- Link to the delete-specific CSS file for styling -->
    <title>Delete Movie</title> <!-- Title of the delete movie page -->
</head>
<body>
<header>
    <?php include('nav.php'); ?> <!-- Include the navigation bar from nav.php -->
</header>
<main>
    <h1>Delete Movie</h1> <!-- Main heading for the delete movie page -->
    <div class="message">
        <?php
        // Connect to the database
        $conn = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME); // Create a new MySQLi object for database connection

        if ($conn->connect_error) { // Check if there is a connection error
            die("Connection failed: " . $conn->connect_error); // Display an error message and terminate the script if connection failed
        }

        $title_id = $_GET['id']; // Get the title ID from the URL parameter
        $sql = "DELETE FROM titles WHERE title_id='$title_id'"; // SQL query to delete the movie with the specified title ID

        if ($conn->query($sql) === TRUE) { // Check if the query executed successfully
            echo "Movie deleted successfully"; // Display a success message if the movie was deleted
        } else {
            echo "Error deleting movie: " . $conn->error; // Display an error message if the query failed
        }

        $conn->close(); // Close the database connection
        ?>
    </div>
    <a href="admin.php" class="btn">Back to Admin Page</a> <!-- Link to go back to the admin page -->
</main>
<script src = "js/admin.js"></script> <!-- Link to the admin-specific JavaScript file -->
<script src = "js/global.js"></script> <!-- Link to the global JavaScript file -->
</body>
</html>

<!-- add.php -->

<?php require_once('../api/config.php'); ?><!-- Include the configuration file that contains database connection details -->

<!doctype html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/Style.css"><!-- Link to the CSS file for styling -->
    <link rel="stylesheet" type="text/css" href="css/add.css"><!-- Link to the CSS file for styling -->
    <title>Add Movie</title>
</head>
<body>
<header>
    <?php include('nav.php'); ?><!-- Include the navigation bar from nav.php -->
</header>
<main>
    <h1>Add New Movie</h1>
    <form action="add.php" method="post"><!-- Form to add a new movie, using POST method -->
        <label for="name">Title:</label><!-- Label for the movie title input -->
        <input type="text" id="name" name="name" required><br><!-- Input for movie title -->
        <label for="release_year">Release Year:</label><!-- Label for the release year input -->
        <input type="number" id="release_year" name="release_year" required><br><!-- Input for release year -->
        <label for="description">Description:</label><!-- Label for the description textarea -->
        <textarea id="description" name="description" required></textarea><br><!-- Textarea for movie description -->
        <label for="duration">Duration:</label><!-- Label for the duration input -->
        <input type="number" id="duration" name="duration" required><br> <!-- Input for duration -->
        <label for="IMDB_rating">IMDB Rating:</label><!-- Label for the IMDB rating input -->
        <input type="number" step="0.1" id="IMDB_rating" name="IMDB_rating" required><br><!-- Input for IMDB rating with step for decimal values -->
        <label for="language_id">Language:</label><!-- Label for the language select dropdown -->
        <select id="language_id" name="language_id" required><!-- Dropdown for selecting language -->
            <?php
            // Fetch language data from the database
            $conn = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);// Create a new MySQLi object for database connection
            if ($conn->connect_error) {// Check if there is a connection error
                die("Connection failed: " . $conn->connect_error);// Display an error message and terminate the script if connection failed
            }
            $sql = "SELECT language_id, name FROM languages";// SQL query to select language_id and name from the 'languages' table
            $result = $conn->query($sql);// Execute the query and store the result set
            if ($result->num_rows > 0) {// Check if there are any rows returned by the query
                while($row = $result->fetch_assoc()) {// Fetch associative array for each row in the result set
                    echo "<option value='{$row['language_id']}'>{$row['name']}</option>";// Output each language as an option in the dropdown
                }
            } else {
                echo "<option value=''>No languages found</option>";// Display a message if no languages are found
            }
            ?>
        </select><br>
        <label for="studio_id">Studio:</label><!-- Label for the studio select dropdown -->
        <select id="studio_id" name="studio_id" required><!-- Dropdown for selecting studio -->
            <?php
            // Fetch studio data from the database
            $sql = "SELECT studio_id, name FROM studios";// SQL query to select studio_id and name from the 'studios' table
            $result = $conn->query($sql);// Execute the query and store the result set
            if ($result->num_rows > 0) {// Check if there are any rows returned by the query
                while($row = $result->fetch_assoc()) {// Fetch associative array for each row in the result set
                    echo "<option value='{$row['studio_id']}'>{$row['name']}</option>";// Output each studio as an option in the dropdown
                }
            } else {
                echo "<option value=''>No studios found</option>";// Display a message if no studios are found
            }
            $conn->close();// Close the database connection
            ?>
        </select><br>
        <input type="submit" value="Add Movie">
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {// Check if the form was submitted using POST method
        $name = $_POST["name"];// Get the movie title from the form
        $release_year = $_POST["release_year"];// Get the release year from the form
        $description = $_POST["description"];// Get the description from the form
        $duration = $_POST["duration"];// Get the duration from the form
        $IMDB_rating = $_POST["IMDB_rating"];// Get the IMDB rating from the form
        $language_id = $_POST["language_id"];// Get the language ID from the form
        $studio_id = $_POST["studio_id"];// Get the studio ID from the form

        $conn = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);// Create a new MySQLi object for database connection

        if ($conn->connect_error) {// Check if there is a connection error
            die("Connection failed: " . $conn->connect_error);// Display an error message and terminate the script if connection failed
        }

        $sql = "INSERT INTO titles (name, release_year, description, duration, IMDB_rating, language_id, studio_id)
                    VALUES ('$name', '$release_year', '$description', '$duration', '$IMDB_rating', '$language_id', '$studio_id')";// SQL query to insert the form data into the 'titles' table

        if ($conn->query($sql) === TRUE) {// Check if the query executed successfully
            header("Location: admin.php");// Redirect to the admin page if the movie was added successfully
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;// Display an error message if the query failed
        }

        $conn->close();// Close the database connection
    }
    ?>
</main>
<script src = "js/global.js"></script>
<script src = "js/admin.js"></script>
</body>
</html>

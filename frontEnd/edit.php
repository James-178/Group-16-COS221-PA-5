<!-- edit.php -->

<?php require_once('../api/config.php'); ?> <!-- Include the configuration file that contains database connection details -->
<!doctype html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/Style.css"> <!-- Link to the general CSS file for styling -->
    <link rel="stylesheet" type="text/css" href="css/edit.css"> <!-- Link to the edit-specific CSS file for styling -->
    <title>Edit Movie</title> <!-- Title of the edit movie page -->
</head>
<body>
<header>
    <?php include('nav.php'); ?> <!-- Include the navigation bar from nav.php -->
</header>
<main>
    <h1>Edit Movie</h1> <!-- Main heading for the edit movie page -->
    <?php
    $conn = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME); // Create a new MySQLi object for database connection

    if ($conn->connect_error) { // Check if there is a connection error
        die("Connection failed: " . $conn->connect_error); // Display an error message and terminate the script if connection failed
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") { // Check if the form was submitted using POST method
        $title_id = $_POST["title_id"]; // Get the movie title ID from the form
        $name = $_POST["name"]; // Get the movie title from the form
        $release_year = $_POST["release_year"]; // Get the release year from the form
        $description = $_POST["description"]; // Get the description from the form
        $duration = $_POST["duration"]; // Get the duration from the form
        $IMDB_rating = $_POST["IMDB_rating"]; // Get the IMDB rating from the form
        $language_id = $_POST["language_id"]; // Get the language ID from the form
        $studio_id = $_POST["studio_id"]; // Get the studio ID from the form

        $sql = "UPDATE titles SET name='$name', release_year='$release_year', description='$description', 
                    duration='$duration', IMDB_rating='$IMDB_rating', language_id='$language_id', studio_id='$studio_id' 
                    WHERE title_id='$title_id'"; // SQL query to update the movie details in the 'titles' table

        if ($conn->query($sql) === TRUE) { // Check if the query executed successfully
            header("Location: admin.php"); // Redirect to the admin page if the movie was updated successfully
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error; // Display an error message if the query failed
        }
    }

    $title_id = $_GET['id']; // Get the movie title ID from the URL parameter
    $sql = "SELECT * FROM titles WHERE title_id='$title_id'"; // SQL query to select the movie details from the 'titles' table
    $result = $conn->query($sql); // Execute the query and store the result set

    if ($result->num_rows > 0) { // Check if there are any rows returned by the query
        $row = $result->fetch_assoc(); // Fetch associative array for the movie details

        // Fetch languages
        $languages = $conn->query("SELECT language_id, name FROM languages"); // Query to fetch all languages

        // Fetch studios
        $studios = $conn->query("SELECT studio_id, name FROM studios"); // Query to fetch all studios
        ?>
        <form action="edit.php" method="post"> <!-- Form to edit the movie details, using POST method -->
            <input type="hidden" name="title_id" value="<?php echo $row['title_id']; ?>"> <!-- Hidden input to store the movie title ID -->
            <label for="name">Title:</label> <!-- Label for the movie title input -->
            <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>" required><br> <!-- Input for movie title with existing value -->
            <label for="release_year">Release Year:</label> <!-- Label for the release year input -->
            <input type="number" id="release_year" name="release_year" value="<?php echo $row['release_year']; ?>" required><br> <!-- Input for release year with existing value -->
            <label for="description">Description:</label> <!-- Label for the description textarea -->
            <textarea id="description" name="description" required><?php echo $row['description']; ?></textarea><br> <!-- Textarea for movie description with existing value -->
            <label for="duration">Duration:</label> <!-- Label for the duration input -->
            <input type="number" id="duration" name="duration" value="<?php echo $row['duration']; ?>" required><br> <!-- Input for duration with existing value -->
            <label for="IMDB_rating">IMDB Rating:</label> <!-- Label for the IMDB rating input -->
            <input type="number" step="0.1" id="IMDB_rating" name="IMDB_rating" value="<?php echo $row['IMDB_rating']; ?>" required><br> <!-- Input for IMDB rating with existing value -->
            <label for="language_id">Language:</label> <!-- Label for the language select dropdown -->
            <select id="language_id" name="language_id" required> <!-- Dropdown for selecting language with existing value -->
                <?php
                if ($languages->num_rows > 0) { // Check if there are any rows returned by the query
                    while($language = $languages->fetch_assoc()) { // Fetch associative array for each language
                        $selected = $language['language_id'] == $row['language_id'] ? "selected" : ""; // Check if the language is the existing one
                        echo "<option value='{$language['language_id']}' $selected>{$language['name']}</option>"; // Output each language as an option in the dropdown
                    }
                } else {
                    echo "<option value=''>No languages found</option>"; // Display a message if no languages are found
                }
                ?>
            </select><br>
            <label for="studio_id">Studio:</label> <!-- Label for the studio select dropdown -->
            <select id="studio_id" name="studio_id" required> <!-- Dropdown for selecting studio with existing value -->
                <?php
                if ($studios->num_rows > 0) { // Check if there are any rows returned by the query
                    while($studio = $studios->fetch_assoc()) { // Fetch associative array for each studio
                        $selected = $studio['studio_id'] == $row['studio_id'] ? "selected" : ""; // Check if the studio is the existing one
                        echo "<option value='{$studio['studio_id']}' $selected>{$studio['name']}</option>"; // Output each studio as an option in the dropdown
                    }
                } else {
                    echo "<option value=''>No studios found</option>"; // Display a message if no studios are found
                }
                ?>
            </select><br>
            <input type="submit" value="Update Movie"> <!-- Submit button for the form -->
        </form>
        <?php
    } else {
        echo "Movie not found"; // Display a message if no movie is found
    }

    $conn->close(); // Close the database connection
    ?>
</main>
<script src = "js/admin.js"></script> <!-- Link to the admin-specific JavaScript file -->
<script src = "js/global.js"></script> <!-- Link to the global JavaScript file -->
</body>
</html>

<!-- admin.php -->

<?php require_once('../api/config.php'); ?><!-- Include the configuration file that contains database connection details -->
<!doctype html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/admin.css"><!-- Link to the CSS file for styling -->
    <link rel="stylesheet" type="text/css" href="css/Style.css"><!-- Link to the CSS file for styling -->
    <title>Admin Page</title>
</head>
<body>
<header>
    <?php include('nav.php'); ?><!-- Include the navigation bar from nav.php -->
</header>
<main>
    <h1>Admin Page</h1>
    <div class="container">
        <h2>Movie List</h2>
        <a href="add.php" class="btn">Add New Movie</a>
        <table>
            <thead>
            <tr>
                <th>Title</th><!-- Table column header for movie title -->
                <th>Release Year</th><!-- Table column header for release year -->
                <th>Description</th><!-- Table column header for movie description -->
                <th>Duration</th><!-- Table column header for movie duration -->
                <th>IMDB Rating</th><!-- Table column header for IMDB rating -->
                <th>Language</th><!-- Table column header for language -->
                <th>Studio</th><!-- Table column header for studio -->
                <th>Actions</th><!-- Table column header for actions (edit/delete) -->
            </tr>
            </thead>
            <tbody>
            <?php
            
            // Connect to the database
            $conn = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);// Display an error message and terminate the script if connection failed
            }

            // Fetch movie data
            $sql = "SELECT * FROM titles";// SQL query to select all columns from the 'titles' table
            $result = $conn->query($sql);// Execute the query and store the result set

            if ($result->num_rows > 0) {// Check if there are any rows returned by the query
                while($row = $result->fetch_assoc()) {// Fetch associative array for each row in the result set
                    echo "<tr>
                                <td>{$row['name']}</td><!-- Display movie title -->
                                <td>{$row['release_year']}</td><!-- Display release year -->
                                <td>{$row['description']}</td><!-- Display description -->
                                <td>{$row['duration']}</td><!-- Display duration -->
                                <td>{$row['IMDB_rating']}</td><!-- Display IMDB rating -->
                                <td>{$row['language_id']}</td><!-- Display language ID (could be replaced with language name) -->
                                <td>{$row['studio_id']}</td><!-- Display studio ID (could be replaced with studio name) -->
                                <td>
                                    <a href='edit.php?id={$row['title_id']}'>Edit</a> | <!-- Link to edit page for the movie -->
                                    <a href='delete.php?id={$row['title_id']}'>Delete</a><!-- Link to delete page for the movie -->
                                </td>
                            </tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No movies found</td></tr>";// Display message if no movies are found
            }

            $conn->close();// Close the database connection
            ?>
            </tbody>
        </table>

    </div>
</main>
<script src = "js/global.js"></script>
<script src="js/admin.js"></script>
</body>
</html>

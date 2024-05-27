<!-- admin.php -->

<?php require_once('../api/config.php'); ?>
<!doctype html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/admin.css">
    <link rel="stylesheet" type="text/css" href="css/Style.css">
    <title>Admin Page</title>
</head>
<body>
<header>
    <?php include('nav.php'); ?>
</header>
<main>
    <h1>Admin Page</h1>
    <div class="container">
        <h2>Movie List</h2>
        <a href="add.php" class="btn">Add New Movie</a>
        <table>
            <thead>
            <tr>
                <th>Title</th>
                <th>Release Year</th>
                <th>Description</th>
                <th>Duration</th>
                <th>IMDB Rating</th>
                <th>Language</th>
                <th>Studio</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php
            
            // Connect to the database
            $conn = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch movie data
            $sql = "SELECT * FROM titles";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                                <td>{$row['name']}</td>
                                <td>{$row['release_year']}</td>
                                <td>{$row['description']}</td>
                                <td>{$row['duration']}</td>
                                <td>{$row['IMDB_rating']}</td>
                                <td>{$row['language_id']}</td>
                                <td>{$row['studio_id']}</td>
                                <td>
                                    <a href='edit.php?id={$row['title_id']}'>Edit</a> | 
                                    <a href='delete.php?id={$row['title_id']}'>Delete</a>
                                </td>
                            </tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No movies found</td></tr>";
            }

            $conn->close();
            ?>
            </tbody>
        </table>

    </div>
</main>
<script src = "js/global.js"></script>
<script src="js/admin.js"></script>
</body>
</html>

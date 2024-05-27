<!-- add.php -->

<?php require_once('../api/config.php'); ?>

<!doctype html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/Style.css">
    <link rel="stylesheet" type="text/css" href="css/add.css">
    <title>Add Movie</title>
</head>
<body>
<header>
    <?php include('nav.php'); ?>
</header>
<main>
    <h1>Add New Movie</h1>
    <form action="add.php" method="post">
        <label for="name">Title:</label>
        <input type="text" id="name" name="name" required><br>
        <label for="release_year">Release Year:</label>
        <input type="number" id="release_year" name="release_year" required><br>
        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea><br>
        <label for="duration">Duration:</label>
        <input type="number" id="duration" name="duration" required><br>
        <label for="IMDB_rating">IMDB Rating:</label>
        <input type="number" step="0.1" id="IMDB_rating" name="IMDB_rating" required><br>
        <label for="language_id">Language:</label>
        <select id="language_id" name="language_id" required>
            <?php
            // Fetch language data from the database
            $conn = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $sql = "SELECT language_id, name FROM languages";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['language_id']}'>{$row['name']}</option>";
                }
            } else {
                echo "<option value=''>No languages found</option>";
            }
            ?>
        </select><br>
        <label for="studio_id">Studio:</label>
        <select id="studio_id" name="studio_id" required>
            <?php
            // Fetch studio data from the database
            $sql = "SELECT studio_id, name FROM studios";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['studio_id']}'>{$row['name']}</option>";
                }
            } else {
                echo "<option value=''>No studios found</option>";
            }
            $conn->close();
            ?>
        </select><br>
        <input type="submit" value="Add Movie">
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST["name"];
        $release_year = $_POST["release_year"];
        $description = $_POST["description"];
        $duration = $_POST["duration"];
        $IMDB_rating = $_POST["IMDB_rating"];
        $language_id = $_POST["language_id"];
        $studio_id = $_POST["studio_id"];

        $conn = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "INSERT INTO titles (name, release_year, description, duration, IMDB_rating, language_id, studio_id)
                    VALUES ('$name', '$release_year', '$description', '$duration', '$IMDB_rating', '$language_id', '$studio_id')";

        if ($conn->query($sql) === TRUE) {
            header("Location: admin.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
    ?>
</main>
<script src = "js/global.js"></script>
<script src = "js/admin.js"></script>
</body>
</html>

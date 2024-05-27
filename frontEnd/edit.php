<!-- edit.php -->

<?php require_once('../api/config.php'); ?>
<!doctype html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/Style.css">
    <link rel="stylesheet" type="text/css" href="css/edit.css">
    <title>Edit Movie</title>
</head>
<body>
<header>
    <?php include('nav.php'); ?>
</header>
<main>
    <h1>Edit Movie</h1>
    <?php
    $conn = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $title_id = $_POST["title_id"];
        $name = $_POST["name"];
        $release_year = $_POST["release_year"];
        $description = $_POST["description"];
        $duration = $_POST["duration"];
        $IMDB_rating = $_POST["IMDB_rating"];
        $language_id = $_POST["language_id"];
        $studio_id = $_POST["studio_id"];

        $sql = "UPDATE titles SET name='$name', release_year='$release_year', description='$description', 
                    duration='$duration', IMDB_rating='$IMDB_rating', language_id='$language_id', studio_id='$studio_id' 
                    WHERE title_id='$title_id'";

        if ($conn->query($sql) === TRUE) {
            header("Location: admin.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $title_id = $_GET['id'];
    $sql = "SELECT * FROM titles WHERE title_id='$title_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Fetch languages
        $languages = $conn->query("SELECT language_id, name FROM languages");

        // Fetch studios
        $studios = $conn->query("SELECT studio_id, name FROM studios");
        ?>
        <form action="edit.php" method="post">
            <input type="hidden" name="title_id" value="<?php echo $row['title_id']; ?>">
            <label for="name">Title:</label>
            <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>" required><br>
            <label for="release_year">Release Year:</label>
            <input type="number" id="release_year" name="release_year" value="<?php echo $row['release_year']; ?>" required><br>
            <label for="description">Description:</label>
            <textarea id="description" name="description" required><?php echo $row['description']; ?></textarea><br>
            <label for="duration">Duration:</label>
            <input type="number" id="duration" name="duration" value="<?php echo $row['duration']; ?>" required><br>
            <label for="IMDB_rating">IMDB Rating:</label>
            <input type="number" step="0.1" id="IMDB_rating" name="IMDB_rating" value="<?php echo $row['IMDB_rating']; ?>" required><br>
            <label for="language_id">Language:</label>
            <select id="language_id" name="language_id" required>
                <?php
                if ($languages->num_rows > 0) {
                    while($language = $languages->fetch_assoc()) {
                        $selected = $language['language_id'] == $row['language_id'] ? "selected" : "";
                        echo "<option value='{$language['language_id']}' $selected>{$language['name']}</option>";
                    }
                } else {
                    echo "<option value=''>No languages found</option>";
                }
                ?>
            </select><br>
            <label for="studio_id">Studio:</label>
            <select id="studio_id" name="studio_id" required>
                <?php
                if ($studios->num_rows > 0) {
                    while($studio = $studios->fetch_assoc()) {
                        $selected = $studio['studio_id'] == $row['studio_id'] ? "selected" : "";
                        echo "<option value='{$studio['studio_id']}' $selected>{$studio['name']}</option>";
                    }
                } else {
                    echo "<option value=''>No studios found</option>";
                }
                ?>
            </select><br>
            <input type="submit" value="Update Movie">
        </form>
        <?php
    } else {
        echo "Movie not found";
    }

    $conn->close();
    ?>
</main>
<script src = "js/admin.js"></script>
<script src = "js/global.js"></script>
</body>
</html>

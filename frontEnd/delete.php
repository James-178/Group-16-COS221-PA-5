<!-- delete.php -->

<?php require_once('../api/config.php'); ?>
<!doctype html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/Style.css">
    <link rel="stylesheet" type="text/css" href="css/delete.css">
    <title>Delete Movie</title>
</head>
<body>
<header>
    <?php include('nav.php'); ?>
</header>
<main>
    <h1>Delete Movie</h1>
    <div class="message">
        <?php
        $conn = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $title_id = $_GET['id'];
        $sql = "DELETE FROM titles WHERE title_id='$title_id'";

        if ($conn->query($sql) === TRUE) {
            echo "Movie deleted successfully";
        } else {
            echo "Error deleting movie: " . $conn->error;
        }

        $conn->close();
        ?>
    </div>
    <a href="admin.php" class="btn">Back to Admin Page</a>
</main>
<script src = "js/admin.js"></script>
<script src = "js/global.js"></script>
</body>
</html>

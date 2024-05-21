<!doctype html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/Style.css">
    <link rel="stylesheet" type="text/css" href="css/delete.css">
    <title>Delete Movie</title>
</head>
<body>
<header>
    <nav class="sticky">
        <div class="row">
            <img src="img/simpleEdit.jpg" width="100" height="100" alt="Website Logo" class="logo"/>
            <ul class="main-nav">
                <li><a href="index.php">Listings</a></li>
                <li><a href="studios.php">Studios</a></li>
                <li><a href="watchlist.php">Watchlist</a></li>
                <li><a href="register.php">Register</a></li>
                <li><a class="current" href="login.php">Login</a></li>
                <li><a href="admin.php">Admin</a></li>
            </ul>
        </div>
    </nav>
</header>
<main>
    <h1>Delete Movie</h1>
    <div class="message">
        <?php
        $conn = new mysqli("your_server", "your_username", "your_password", "your_database");

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
</body>
</html>

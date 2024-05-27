<!doctype html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/Style.css">
	<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;1,300&display=swap" rel="stylesheet">
	
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
	
	<title>Favourites</title>
</head>

<body>
<header>
		<nav class="sticky">
           <div class="row">
               <img src="img/simpleEdit.jpg" width = "100" height= "100" alt="Website Logo" class = "logo"/>
                    <ul class="main-nav">
                        <li><a href="index.php">Listings</a></li>
                        <li><a href="studios.php">Studios</a></li>
                        <li><a class="current" href="watchlist.php">Watchlist</a></li>
                        <li><a href="register.php">Register</a></li>
                        <li><a href="login.php">Login</a></li>
                    </ul>
           </div>
        </nav> 
		<div class="hero-text-box">
			<h1 class="title">Watchlist</h1>
		</div>
        <span class="favourites">
            <div class="favourite-tile">
                <a href="view.php"><img src="img/ironman.jpg" width="300" height="300" alt="image of movie" class="movieImage"></a>
                <p>
                    Title: Iron man<br>
                    Release Year: 2008<br>
                    Genre: Superhero<br>
                    Language: English<br>
                    IMDB-Rating: 9
                </p>
                <div class="btn">Remove from Watchlist</div>
            </div>
            <div class="favourite-tile">
                <a href="view.php"><img src="img/Matrix.jpg" width="300" height="300" alt="image of movie" class="movieImage"></a>
                <p>
                    Title: The Matrix<br>
                    Release Year: 1999<br>
                    Genre: Sci-fi<br>
                    Language: English<br>
                    IMDB-Rating: 9.7
                </p>
                <div class="btn">Remove from Watchlist</div>
            </div>
            <div class="favourite-tile">
                <a href="view.php"><img src="img/Pantheon.jpg" width="300" height="300" alt="image of movie" class="movieImage"></a>
                <p>
                    Title: Pantheon<br>
                    Release Year: 2022<br>
                    Genre: Sci-fi<br>
                    Language: English<br>
                    IMDB-Rating: 9
                </p>
                <div class="btn">Remove from Watchlist</div>
            </div>
        </span>
</header>
<script src = "js/global.js"></script>
</body>
</html>
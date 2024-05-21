<!doctype html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/Style.css">
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;1,300&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <title>Index</title>
</head>

<body>
<header>
    <nav class="sticky">
        <div class="row">
            <img src="img/simpleEdit.jpg" width="100" height="100" alt="Website Logo" class="logo"/>
            <ul class="main-nav">
                <li><a class="current" href="index.php">Listings</a></li>
                <li><a href="studios.php">Studios</a></li>
                <li><a href="watchlist.php">Watchlist</a></li>
                <li><a href="register.php">Register</a></li>
                <li><a href="login.php">Login</a></li>
            </ul>
        </div>
    </nav>

    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

    <div class="hero-text-box">
        <h1 class="title">Find Something to watch</h1>
        <div class="options">
            <div class="btnList">
                <li><a id = "movie-filter" href="#">MOVIES</a></li>
                <li><a id = "series-filter" href="#">SERIES</a></li>
            </div>
        </div>
        <div><input type="text" placeholder="Search..."></div>
        <div class="dropdown">
            <button class="dropbtn">Release Year</button>
            <div class="dropdown-content">
                <input id="year" type="number" value="2024"><br>
            </div>
        </div>
        <div class="dropdown">
            <button class="dropbtn">Language</button>
            <div class="dropdown-content" id = "lang" style="overflow-y: auto; max-height: 200px;">
                <!-- <label class="container">English
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>
                <label class="container">Russian
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>
                <label class="container">Japanese
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>
                <label class="container">Arabic
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label> -->
            </div>
        </div>
        <div class="dropdown">
            <button class="dropbtn">Genres</button>
            <div class="dropdown-content" id = "genre" style="overflow-y: auto; max-height: 200px;">
                <!-- <label class="container">Horror
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>
                <label class="container">Fantasy
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>
                <label class="container">Romance
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>
                <label class="container">Reality
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label> -->
            </div>
        </div>
        <div class="dropdown">
            <button class="dropbtn">IMDB score</button>
            <div class="dropdown-content">
                <label class="container">0 - 2
                    <input type="checkbox" id = "imdb1">
                    <span class="checkmark"></span>
                </label>
                <label class="container">2 - 4
                    <input type="checkbox" id = "imdb2">
                    <span class="checkmark"></span>
                </label>
                <label class="container">4 - 6
                    <input type="checkbox" id = "imdb3">
                    <span class="checkmark"></span>
                </label>
                <label class="container">6 - 8
                    <input type="checkbox" id = "imdb4">
                    <span class="checkmark"></span>
                </label>
                <label class="container">8 - 10
                    <input type="checkbox" id = "imdb5">
                    <span class="checkmark"></span>
                </label>
            </div>
        </div>
        <div class="sort">
            <div class="dropdown">
                <button class="dropbtn">Sort</button>
                <div class="dropdown-content">
                    <label class="container">Title
                        <input id = "title-check" type="checkbox">
                        <span class="checkmark"></span>
                    </label>
                    <label class="container">Rating
                        <input id = "rating-check" type="checkbox">
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
        </div>

        <div class = sort>
            <button class = "dropbtn" id = "filter">Filter</button> 
        </div>
        
    </div>

    

    <span class="listings" id = "listings">
        <!-- <div class="tile">
            <a href="view.php"><img src="img/ironman.jpg" width="300" height="300" alt="image of movie" class="movieImage"></a>
            <p>
                Title: Iron man<br>
                Release Year: 2008<br>
                Genre: Superhero<br>
                Language: English<br>
                IMDB-Rating: 9
            </p>
            <div class="btn">Add to Watchlist</div>
        </div>
        <div class="tile">
            <a href="view.php"><img src="img/Matrix.jpg" width="300" height="300" alt="image of movie" class="movieImage"></a>
            <p>
                Title: The Matrix<br>
                Release Year: 1999<br>
                Genre: Sci-fi<br>
                Language: English<br>
                IMDB-Rating: 9.7
            </p>
            <div class="btn">Add to Watchlist</div>
        </div>
        <div class="tile">
            <a href="view.php"><img src="img/Pantheon.jpg" width="300" height="300" alt="image of movie" class="movieImage"></a>
            <p>
                Title: Pantheon<br>
                Release Year: 2022<br>
                Genre: Sci-fi<br>
                Language: English<br>
                IMDB-Rating: 9
            </p>
            <div class="btn">Add to Watchlist</div>
        </div>
        <div class="tile">
            <a href="view.php"><img src="img/AOT.jpg" width="300" height="300" alt="image of movie" class="movieImage"></a>
            <p>
                Title: Attack on Titan<br>
                Release Year: 2013<br>
                Genre: Fantasy<br>
                Language: Japanese<br>
                IMDB-Rating: 10
            </p>
            <div class="btn">Add to Watchlist</div>
        </div>
        <div class="tile">
            <a href="view.php"><img src="img/Edgerunners.jpg" width="300" height="300" alt="image of movie" class="movieImage"></a>
            <p>
                Title: Edgerunners<br>
                Release Year: 2022<br>
                Genre: Sci-fi<br>
                Language: English<br>
                IMDB-Rating: 9.5
            </p>
            <div class="btn">Add to Watchlist</div>
        </div> -->
    </span>
</header>
<script src="js/index.js"></script>
</body>
</html>

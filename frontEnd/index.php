<!-- index.php -->

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
     <!-- Navigation file -->
    <?php include('nav.php'); ?>

    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

     <!-- Contains all the header info such as title and includes the filtering options -->
    <div class="hero-text-box">
        <h1 class="title">Find Something to watch</h1>
         <!-- movie or series button -->
        <div class="options">
            <div class="btnList">
                <li><a id = "movie-filter" href="#">MOVIES</a></li>
                <li><a id = "series-filter" href="#">SERIES</a></li>
            </div>
        </div>
         <!-- Search bar -->
        <div><input type="text" id = "search-bar" placeholder="Search..."></div>

         <!-- dropdown  filters-->
        
        <div class="dropdown">
            <button class="dropbtn">Language</button>
            <div class="dropdown-content" id = "lang" style="overflow-y: auto; max-height: 200px;">
                
            </div>
        </div>
        <div class="dropdown">
            <button class="dropbtn">Genres</button>
            <div class="dropdown-content" id = "genre" style="overflow-y: auto; max-height: 200px;">
                
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

        <!-- sort filter -->
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

    
     <!-- Container where movies/series will be loaded -->
    <span class="listings" id = "listings">
        
    </span>
</header>
<script src="js/index.js"></script>
<script src = "js/global.js"></script>
</body>
</html>

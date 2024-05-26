<!doctype html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/recommend.css">
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;1,300&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <title>Recommend</title>
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
                <li><a class="current" href="recommend.php">Recommendations</a></li>
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
    <br>

    <div class="hero-text-box">
        <h1 class="title">What are you in the Mood for?</h1>
       
    
        <div class="dropdown">
            <button class="dropbtn">Release Year</button>
            <div class="dropdown-content">
                <input id="year" type="number" value="2020"><br>
            </div>
        </div>
        <div class="dropdown">
            <button class="dropbtn">Duration</button>
            <div class="dropdown-content">
                <label class="container">Quick
                    <input type="radio" name="duration" id="Quick">
                    <span class="checkmark"></span>
                </label>
                <label class="container">Short
                    <input type="radio" name="duration" id="Short">
                    <span class="checkmark"></span>
                </label>
                <label class="container">Medium
                    <input type="radio" name="duration" id="Medium">
                    <span class="checkmark"></span>
                </label>
                <label class="container">Long
                    <input type="radio" name="duration" id="Long">
                    <span class="checkmark"></span>
                </label>
            </div>
        </div>
        <div class="dropdown">
            <button class="dropbtn">Movie or Series</button>
            <div class="dropdown-content">
                <label class="container">Movie
                    <input type="radio" name="type" id="Movie">
                    <span class="checkmark"></span>
                </label>
                <label class="container">Series
                    <input type="radio" name="type" id="Series">
                    <span class="checkmark"></span>
                </label>
            </div>
        </div>
        <div class="dropdown">
                <button class="dropbtn">Language</button>
                <div class="dropdown-content">
                    <label class="container">English
                        <input type="radio" name="language" id="English">
                        <span class="checkmark"></span>
                    </label>
                    <label class="container">Italian
                        <input type="radio" name="language" id="Italian">
                        <span class="checkmark"></span>
                    </label>
                    <label class="container">Japanese
                        <input type="radio" name="language" id="Japanese">
                        <span class="checkmark"></span>
                    </label>
                    <label class="container">Mandarin
                        <input type="radio" name="language" id="Mandarin">
                        <span class="checkmark"></span>
                    </label>
                    <label class="container">French
                        <input type="radio" name="language" id="French">
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>

        <div class = "btn" id= "Recommend">Recommend</div>
        
    </div>

    <!-- <span class="studios" id="studios"></span>  -->

    <script type="text/javascript" src="JS/recommend.js"></script>
    
</header>



</body>
</html>

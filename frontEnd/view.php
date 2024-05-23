<!doctype html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/Style.css">
	<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;1,300&display=swap" rel="stylesheet">
	
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
	
	<title>View</title>
</head>

<body>
<header>
		<nav class="sticky">
           <div class="row">
               <img src="img/simpleEdit.jpg" width = "100" height= "100" alt="Website Logo" class = "logo"/>
                    <ul class="main-nav">
                        <li><a href="index.php">Listings</a></li>
                        <li><a href="studios.php">Studios</a></li>
                        <li><a href="watchlist.php">Watchlist</a></li>
                        <li><a href="register.php">Register</a></li>
                        <li><a href="login.php">Login</a></li>
                    </ul>
           </div>
        </nav> 
            <div class="movieInfo">
                <div class="shortInfo">
                    <img id="view-image" src="" alt="image of movie" width="300" height="300">
                    <div id="view-info"></div>
                </div>

                <div class="longInfo">
                    <h2>Description</h2>
                    <p id="Description"></p>
                    <div class="viewPeople">
                        <div class="people">
                            <h2>Actors</h2>
                                <ul id="Actors"></ul>
                        </div>

                        <div class="people">
                            <h2>Crew</h2>
                                <ul id="Crew"></ul>
                        </div>

                        <div class="people">
                            <h2>Director</h2>
                                <ul id="Director"></ul>
                        </div>
                    </div>

                    <h2>Reviews</h2>
                    <p id="Reviews"></p>

                    <h2 align="left" margin-left="50px">Leave a Review</h2>
                    <form action="" id="view-form">
                        <label for="review"></label>
                        <textarea id="review" name="review" rows="4"cols="50">Great Movie!!!</textarea>
                        <div class="dropdown">
                            <button class="dropbtn">Review Score:</button>
                            <div class="dropdown-content">
                                <input id="rating" type="number" value="9">
                            </div>
                        </div>
                        <br>
                        <div class="btn" onclick="submitReview()">Submit</div>
                    </form>
                </div>
            </div>
                    
</header>
<script type="text/javascript" src="JS/view.js"></script>

</body>
</html>
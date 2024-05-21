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
                        <li><a href="index.html">Listings</a></li>
                        <li><a href="studios.html">Studios</a></li>
                        <li><a href="watchlist.html">Watchlist</a></li>
                        <li><a href="register.php">Register</a></li>
                        <li><a href="login.php">Login</a></li>
                    </ul>
           </div>
        </nav> 
            <div class="movieInfo">
                <div class="shortInfo">
                    <img src="img/ironman.jpg" alt="image of movie" width="300" height="300">
                    <p>
                        Title: Iron man<br>
                        Release Year: 2008<br>
                        Genre: Sci-fi<br>
                        Language: English<br>
                        IMDB-Rating: 9.7<br>
                        Duration: 1 
                    </p>
                </div>
                <div class="longInfo">
                    <h2>Description</h2>
                    <p>
                        Iron Man is a 2008 American superhero film based on the Marvel Comics character of the same name. 
                        Produced by Marvel Studios and distributed by Paramount Pictures,[a] it is the first film in the Marvel Cinematic Universe (MCU). 
                        Directed by Jon Favreau from a screenplay by the writing teams of Mark Fergus and Hawk Ostby, and Art Marcum and Matt Holloway, 
                        the film stars Robert Downey Jr. as Tony Stark / Iron Man alongside Terrence Howard, Jeff Bridges, Gwyneth Paltrow, Leslie Bibb, and Shaun Toub. 
                        In the film, following his escape from captivity by a terrorist group, world-famous industrialist and master engineer Tony Stark builds a mechanized suit of armor and 
                        becomes the superhero Iron Man. 
                    </p>
                    <div class="viewPeople">
                        <div class="people">
                            <h2>Actors</h2>
                                <ul>
                                    <li>Robert Downey JR</li> 
                                    <li>Robert Downey JR</li> 
                                    <li>Robert Downey JR</li>
                                </ul>
                        </div>

                        <div class="people">
                            <h2>Directors</h2>
                                <ul>
                                    <li>Robert Downey JR</li> 
                                    <li>Robert Downey JR</li> 
                                    <li>Robert Downey JR</li> 
                                </ul>
                        </div>

                        <div class="people">
                            <h2>Crew</h2>
                                <ul>
                                    <li>Robert Downey JR</li>
                                    <li>Robert Downey JR</li>  
                                    <li>Robert Downey JR</li> 
                                </ul>
                        </div>
                    </div>


                    <h2>Leave a Review: </h2>
                    <form action="" id="view-form">
                        <label for="review"></label>
                        <textarea id="review" name="review" rows="4"cols="50">Great Movie!!!</textarea>
                        <div class="dropdown">
                            <button class="dropbtn">Review Score:</button>
                            <div class="dropdown-content">
                                <input id="reviewScore" type="number" value="9">
                            </div>
                        </div>
                        <br>
                        <div class="btn">Submit</div>
                    </form>
                </div>
            </div>
                    
</header>
</body>
</html>
<!-- view.php -->

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
    <!-- include the nav.php file -->
    <?php include('nav.php'); ?>

    <!-- Container conatining all the movie info, there is 2 sections. A long section for big info and a short section for small info  -->
    <div class="movieInfo">
        <!-- Short info -->
        <div class="shortInfo">
            <!-- Movie image and and info on title, duration, released year e.t.c-->
            <img id="view-image" src="" alt="image of movie" width="300" height="300">
            <div id="view-info"></div>
        </div>

        <!-- Long info -->
        <div class="longInfo">
             <!-- Contains a description of the movie -->
            <h2>Description</h2>
            <p id="Description"></p>

             <!-- Contains all the different people who worked on the movie and their roles-->
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

             <!-- Container to display the reviews of the movie by users -->
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
                 <!-- button to send a review -->
                <div class="btn" onclick="submitReview()">Submit</div>
            </form>
        </div>
    </div>
                    
</header>
<script type="text/javascript" src="JS/view.js"></script>
<script src = "js/global.js"></script>
</body>
</html>
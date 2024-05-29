//view.js

// Check if user is logged in
if(!localStorage.hasOwnProperty("api_key")){
    window.location.href = "login.php";
    
}else{
    // Get the title id parsed through the URL
    var id = window.location.href.split("?")[1];

    // function to load the view with the movie/series info
    function loadView(params){
        const titleDataReq = new XMLHttpRequest();
        titleDataReq.onload = function(){
            if(this.status == 200){

                res = JSON.parse(this.responseText);
                let data = res.data;
                data.forEach(movie => {
                    const imageRequest = new XMLHttpRequest();
                    imageRequest.onload = function() 
                    {
                        // load the image
                        img = document.getElementById("view-image");
                        if(this.status === 200)
                        {
                            var imageresponse = JSON.parse(imageRequest.responseText);
                            if (imageresponse.id !== null)
                            { 
                                    
                                if (imageresponse.posters[0].length !== 0) 
                                {
                                    img.src = "https://image.tmdb.org/t/p/w500/" + imageresponse.posters[0].file_path;
                                    img.width = 300;
                                    img.height = 300;
                                    img.alt = 'image of movie';
                                    img.className = 'movieImage';
                                }
                            }
                        }
                        else
                        {  
                            img.src = "img/simpleEdit.jpg";
                            img.width = 300;
                            img.height = 300;
                            img.alt = 'image of movie';
                            img.className = 'movieImage';
                                
                        }
                        
                    }
                    // GET image from themoviedb API
                    imageRequest.open('GET', `https://api.themoviedb.org/3/movie/${movie.title_id}/images`);
                    imageRequest.setRequestHeader('accept', 'application/json');
                    imageRequest.setRequestHeader('Authorization', 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJmMDhjNzk1ZDlmY2JmMzczZDMyZGZhNzVlZDIzYjUzNyIsInN1YiI6IjY2NGNhODAyZmQ0MWQ1M2NhZmYyZGRlMyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.gkyF7TnTPIp4G-J6gMfFuETtXZe6TSw1wk7Yip9zt2U');
                    imageRequest.send();
                    
                    // loading containers with the correct data
                    const p = document.createElement('p');
                    p.innerHTML = `
                    Title: ${movie.name}<br>
                    Genre: ${movie.genres}<br>
                    Language: ${movie.language_name}<br>
                    Release Year: ${movie.release_year}<br>
                    IMDB-Rating: ${movie.IMDB_rating}<br>
                    Duration: ${movie.duration}<br>
                    Studio: ${movie.studio_name}
                    `;
                    // removing any old data that was previously in the container
                    var shortInfo = document.getElementById("view-info");
                    if(shortInfo.lastElementChild !== null)
                    {
                        let child = shortInfo.lastElementChild;
                        while (child) {
                            shortInfo.removeChild(child);
                            child = shortInfo.lastElementChild;
                        }
                    }

                    // appending the new data to the container
                    document.getElementById("view-info").appendChild(p);

                    // loading description info
                    document.getElementById("Description").innerHTML = movie.description;


                    // loading actors info
                    var actors = document.getElementById("Actors");
                    if(actors.lastElementChild !== null)
                    {
                        child = actors.lastElementChild;
                        while (child) {
                            actors.removeChild(child);
                            child = actors.lastElementChild;
                        }
                        movie.actor_names.forEach(actor => {
                            const li = document.createElement('li');
                            li.innerHTML = actor;
                            document.getElementById("Actors").appendChild(li);
                        });
                    }

                    child = actors.lastElementChild;
                    while (child) 
                    {
                        actors.removeChild(child);
                        child = actors.lastElementChild;
                    }
                    movie.actor_names.forEach(actor => {
                        const li = document.createElement('li');
                        li.innerHTML = actor;
                        document.getElementById("Actors").appendChild(li);
                    });

                    // loading crew info
                    var crew = document.getElementById("Crew");
                    child = crew.lastElementChild;
                    while (child) 
                    {
                        crew.removeChild(child);
                        child = crew.lastElementChild;
                    }
                    movie.crew.forEach(crew => {
                        const li = document.createElement('li');
                        li.innerHTML = crew;
                        document.getElementById("Crew").appendChild(li);
                    });

                    // loading director info
                    const director = document.createElement('li');
                    var directorContainer = document.getElementById("Director");
                    if(directorContainer.lastElementChild !== null)
                    {
                        directorContainer.removeChild(directorContainer.lastElementChild);
                    }
                    if(movie.director === null)
                    {
                        director.innerText = "UNKNOWN";
                    }
                    else
                    {
                        director.innerHTML = movie.director;
                    }
                    directorContainer.appendChild(director);

                    
                    // loading review info
                    var reviews = document.getElementById("Reviews");
                    child = reviews.lastElementChild;
                    while (child) 
                    {
                        reviews.removeChild(child);
                        child = reviews.lastElementChild;
                    }
                    movie.reviews.forEach(review => {
                        const p = document.createElement('p');
                        p.innerHTML = review;
                        document.getElementById("Reviews").appendChild(p);
                    });

                });
            
            }
        }
        titleDataReq.open("POST", "https://localhost/Group-16-COS221-PA-5/api/movie_api_v3.php");
        titleDataReq.send(JSON.stringify(params));
    }

    // title data to send
    let title = {
        type:"GetTitle",
        api_key:localStorage.getItem("api_key"),
        title_id: id
    }

    loadView(title);

    // Function to submit a review
    function submitReview()
    {
        const review = document.getElementById("review");
        const rating = document.getElementById("rating");

        const sendData = new XMLHttpRequest();
        
        sendData.onload = function(){
            if(this.status === 200)
            {
                res = JSON.parse(this.response);

                if(res.status !== "success")
                {
                    console.log("review not sent");
                    console.log(res.data);
                }
                else if(res.status === "success")
                {
                    console.log("review sent");
                    // call the loadView function if review sent to refresh the data 
                    loadView(title);
                }
            }
        }

        // Data to send to add review
        const params = {
            "type" : "addReview",
            "api_key": localStorage.getItem("api_key"),
            "review": review.value,
            "rating": rating.value,
            "title_id": id 
        }


        sendData.open("POST", "https://localhost/Group-16-COS221-PA-5/api/movie_api_v3.php");
        sendData.send(JSON.stringify(params));
    }
}
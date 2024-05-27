//recommend.js
//Allow users to be recommended titles based on what they search by.

if(!localStorage.hasOwnProperty("api_key")){
    window.location.href = "login.php";
    
}else{

    var recommend = document.getElementById("Recommend");
    recommend.addEventListener("click", function(){

        //Store all the variables that will be used in the recommendation
        
        //Release Year:
        var release_year = document.getElementById("year").value;
        //The Duration:
        var Quick = document.getElementById("Quick").checked;
        var Short = document.getElementById("Short").checked;
        var Medium = document.getElementById("Medium").checked;
        var Long = document.getElementById("Long").checked;
        //A movie or a series:
        var Movie = document.getElementById("Movie").checked;
        var Series = document.getElementById("Series").checked;
        //The language:
        var English = document.getElementById("English").checked;
        var Italian = document.getElementById("Italian").checked;
        var Japanese = document.getElementById("Japanese").checked;
        var Mandarin = document.getElementById("Mandarin").checked;
        var French = document.getElementById("French").checked;

        //Duration of the movie
        if (Quick == true) 
        {
            var duration = "Quick";
        }
        else if(Short == true)
        {
            var duration = "Short";
        }
        else if(Long == true)
        {
            var duration = "Long";
        }
        else if(Medium == true)
        {
            var duration = "Medium";
        }
        else
        {
            var duration = null;
        }

        //isMovie (Movie or series)
        if (Movie == true) 
        {
            var is_Movie = "1";    
        }
        else if(Series == true)
        {
            var is_Movie = "0";    
        }
        else
        {
            var is_Movie = null;
        }

        //Language of the Movie
        if (English == true) 
        {
            var language = 1;
        }
        else if(Italian == true)
        {
            var language = 2;
        }
        else if(Japanese == true)
        {
            var language = 3;
        }
        else if(Mandarin == true)
        {
            var language = 4;
        }
        else if(French == true)
        {
            var language = 5;
        }
        else
        {
            var language = null;
        }

        var requestRec = new XMLHttpRequest();
        requestRec.open("POST","https://localhost/Group-16-COS221-PA-5/api/movie_api_v3.php");
        requestRec.setRequestHeader("Content-Type", "application/json");

        //Send the request to the API.
        requestRec.send(JSON.stringify(
        {
            type: "recommend",
            search : {release_year,duration,is_Movie},
            api_key: localStorage.getItem("api_key")
        }));


        requestRec.onload = function()
        {   
            
            //if the response has nothing.
            if (!this.responseText) return;
            var response = JSON.parse(requestRec.responseText);

        
            if (response.status === 'success') 
            { 
                //Successful response.
                if (response.data.length == 0) 
                {
                    alert("No titles found with these filters");
                    return;
                }

                //Creating the the div that holds all the recommended images and information if it has not already been created.
                const listingsContainer = document.getElementById('studios') || document.createElement('div');
                listingsContainer.id = 'studios';
                document.body.appendChild(listingsContainer);

                if (listingsContainer) 
                {
                    //Remove all existing listings so that the new filtered titles can be displayed and not the previous ones.
                    while (listingsContainer.firstChild) 
                    {
                        listingsContainer.removeChild(listingsContainer.firstChild);
                    }
                    
                } 

                for (let i = 0; i < response.data.length; i++) 
                {
                    createListing2(i, response, listingsContainer);
                }  
            
            } 
            else 
            {
                //Unsuccessful response
                //if there are no titles based on the filters 
                //then it sends an alert to the user and removes their previous filtered ilms if there are any.
            
                alert(response.message);

                const listingsContainer = document.getElementById('studios') || document.createElement('div');
                listingsContainer.id = 'studios';
                document.body.appendChild(listingsContainer);

                if (listingsContainer) 
                {
                    //Remove all existing listings
                    while (listingsContainer.firstChild) 
                    {
                    listingsContainer.removeChild(listingsContainer.firstChild);
                    }
                    
                } 
            }
        }
    });

    function createListing2(index, response, listingsContainer) 
    {
        const tile = document.createElement('div');
        tile.classList.add('tile');
        //Add an event listner that takes the user to the View page to see more information about the title they clicked on.
        tile.addEventListener("click", function(){
            window.location.href = "view.php?"+response.data[index][0].title_id;
        });
    
        listingsContainer.appendChild(tile);

        const image = document.createElement('img');
        const imageRequest = new XMLHttpRequest();

        // API that we are using for studio/movie images
        imageRequest.open("GET", `https://api.themoviedb.org/3/movie/${response.data[index][0].title_id}/images`);
        imageRequest.setRequestHeader('accept', 'application/json');
        imageRequest.setRequestHeader('Authorization', 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJmMDhjNzk1ZDlmY2JmMzczZDMyZGZhNzVlZDIzYjUzNyIsInN1YiI6IjY2NGNhODAyZmQ0MWQ1M2NhZmYyZGRlMyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.gkyF7TnTPIp4G-J6gMfFuETtXZe6TSw1wk7Yip9zt2U');
        


        imageRequest.onload = function() 
        {
            var imageresponse = JSON.parse(imageRequest.responseText);
            
            if (this.status == 200)
            { 
                //successul response
                //if an image response was returbed by the API.
                image.src = "https://image.tmdb.org/t/p/original/" + imageresponse.posters[0].file_path;  
                image.width = 300;
                image.height = 300;          
            }
            else
            {
                //if the response was unsuccessul set the image.src to a default image.
                image.src = 'img/simpleEdit.jpg';
                image.width = 300;
                image.height = 300;
            }
    
        }
    
        imageRequest.send();

        tile.appendChild(image);

        //create all the elements that relate a titles information.
        const name = document.createElement('p');
        name.innerText = "Film name: " + response.data[index][0].name;
        tile.appendChild(name);

        const year = document.createElement('p');
        year.innerText = "Year Released: " + response.data[index][0].release_year;
        tile.appendChild(year);

        const dur = document.createElement('p');
        dur.innerText = "Duration : " + response.data[index][0].duration;
        tile.appendChild(dur);

        const Genre = document.createElement('p');
        Genre.innerText = "Genres : " + response.data[index][0].genres;
        tile.appendChild(Genre);

        const IMBD = document.createElement('p');
        IMBD.innerText = "IMBD-Rating : " + response.data[index][0].IMDB_rating;
        tile.appendChild(IMBD);

        const language = document.createElement('p');
        language.innerText = "Language : " + response.data[index][0].language_name;
        tile.appendChild(language);

        document.body.appendChild(listingsContainer);
    }
}
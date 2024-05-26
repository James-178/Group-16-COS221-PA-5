var recommend = document.getElementById("Recommend");

recommend.addEventListener("click", function(){

    var release_year = document.getElementById("year").value;
    var Quick = document.getElementById("Quick").checked;
    var Short = document.getElementById("Short").checked;
    var Medium = document.getElementById("Medium").checked;
    var Long = document.getElementById("Long").checked;
    var Movie = document.getElementById("Movie").checked;
    var Series = document.getElementById("Series").checked;
    var English = document.getElementById("English").checked;
    var Italian = document.getElementById("Italian").checked;
    var Japanese = document.getElementById("Japanese").checked;
    var Mandarin = document.getElementById("Mandarin").checked;
    var French = document.getElementById("French").checked;

    //Duration
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

    //isMovie
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

    //language
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
    //http://localhost/Group-16-COS221-PA-5/frontEnd/login.php
    requestRec.open("POST","http://localhost/Group-16-COS221-PA-5/api/movie_api_v2.php");
    requestRec.setRequestHeader("Content-Type", "application/json");

    requestRec.send(JSON.stringify(
    {
        type: "recommend",
        search : {release_year,duration,is_Movie},
        api_key: "1L9v3SkNkKxUcARx3YxL" // localstorage.getItem("api_key")
    }));

    requestRec.onload = function()
    {   
        
        if (!this.responseText) return;
        var response = JSON.parse(requestRec.responseText);

        console.log(response);
    
        if (response.status === 'success') 
        { 
            if (response.data.length == 0) 
            {
                alert("No titles found with these filters");
                return;
            }

            // <span class="studios" id="studios"></span> 

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

            for (let i = 1; i < response.data.length; i++) 
            {
                createListing2(i, response, listingsContainer);
            }  
           
        } 
        else 
        {
           
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
        // var apiKey = localStorage.getItem("apikey");
        // console.log(apiKey);
    }
});

function createListing2(index, response, listingsContainer) 
{

    // if (!this.responseText) return;
    

    // console.log(response);
    const tile = document.createElement('div');
    tile.classList.add('tile');

 
    listingsContainer.appendChild(tile);
    
    const image = document.createElement('img');

    const imageRequest = new XMLHttpRequest();

    // API that im using for studio images
    imageRequest.open("GET", `https://api.themoviedb.org/3/movie/${index}/images`);
    imageRequest.setRequestHeader('accept', 'application/json');
    imageRequest.setRequestHeader('Authorization', 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJmMDhjNzk1ZDlmY2JmMzczZDMyZGZhNzVlZDIzYjUzNyIsInN1YiI6IjY2NGNhODAyZmQ0MWQ1M2NhZmYyZGRlMyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.gkyF7TnTPIp4G-J6gMfFuETtXZe6TSw1wk7Yip9zt2U');
    

    imageRequest.onload = function() 
    {
        var imageresponse = JSON.parse(imageRequest.responseText);
        tile.addEventListener("click", function(){
            window.location.href = "view.php?"+imageresponse.id;
        });
        if (this.status == 200)
        { 
            console.log(imageresponse);
            image.src = "https://image.tmdb.org/t/p/original/" + imageresponse.posters[0].file_path;  
            image.width = 300;
            image.height = 300;          
        }
        else
        {
            image.src = 'img/simpleEdit.jpg';
            image.width = 300;
            image.height = 300;
        }
 
    }

    // image.classList.add('movieImage');

    //};
  
    imageRequest.send();

    tile.appendChild(image);

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
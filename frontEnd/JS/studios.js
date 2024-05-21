document.addEventListener("DOMContentLoaded",function()
{

    var requestStudio = new XMLHttpRequest();
    //http://localhost/Group-16-COS221-PA-5/frontEnd/login.php
    requestStudio.open("POST","http://localhost/Group-16-COS221-PA-5/api/movie_api_v2.php");
    requestStudio.setRequestHeader("Content-Type", "application/json");

    requestStudio.send(JSON.stringify(
    {
        type: "studios",
        api_key: "1L9v3SkNkKxUcARx3YxL" // localstorage.getItem("api_key")
    }));

    requestStudio.onload = function()
    {   
        
        if (!this.responseText) return;
        var response = JSON.parse(requestStudio.responseText);

        console.log(response);
    
        if (response.status === 'success') 
        { 
            for (let i = 1; i < response.data[0].length; i++) 
            {
                createListing2(i, response);
            }  
            console.log("working");
        } 
        else 
        {
            alert(response.message);
        }
        // var apiKey = localStorage.getItem("apikey");
        // console.log(apiKey);
    }
});

    function createListing2(index, response) 
    {
  
       

        const imageRequest = new XMLHttpRequest();

        // API that im using for studio images
        imageRequest.open("GET", `https://api.themoviedb.org/3/company/${index}/images`, false);
        imageRequest.setRequestHeader('accept', 'application/json');
        imageRequest.setRequestHeader('Authorization', 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJmMDhjNzk1ZDlmY2JmMzczZDMyZGZhNzVlZDIzYjUzNyIsInN1YiI6IjY2NGNhODAyZmQ0MWQ1M2NhZmYyZGRlMyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.gkyF7TnTPIp4G-J6gMfFuETtXZe6TSw1wk7Yip9zt2U');
      
        imageRequest.onload = function() 
        {

            // if (!this.responseText) return;
            var imageresponse = JSON.parse(imageRequest.responseText);

            // console.log(response);

            if (imageresponse.id !== null)
            { 
                
                console.log(imageresponse);

                if (imageresponse.logos.length !== 0) 
                {

                    var spanContainer = document.getElementById("studios");

                    const tile = document.createElement('div');
                    tile.classList.add('tile');
                  
                    spanContainer.appendChild(tile);
                    
                    const image = document.createElement('img');
                    image.classList.add('movieImage');
                    image.src = "https://image.tmdb.org/t/p/original/" + imageresponse.logos[0].file_path;
                    tile.appendChild(image);


                    const name = document.createElement('p');
                    name.innerText = "Studio Name: " + response.data[0][index].name;
                    tile.appendChild(name);

                    const Address = document.createElement('p');
                    Address.innerText = "Address: " + response.data[0][index].street_number 
                    + " " + response.data[0][index].street + " " + response.data[0][index].city
                    + " " + response.data[0][index].province + " " + response.data[0][index].country;
                    tile.appendChild(Address);

                    document.body.appendChild(spanContainer);
                }
            }
            else
            {
                console.log("Resource could not be found");
            }
  
        }

        //};
      
        imageRequest.send();
    }
    

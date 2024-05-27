//studios.js

if(!localStorage.hasOwnProperty("api_key")){
    window.location.href = "login.php";
    
}else{
    document.addEventListener("DOMContentLoaded",function()
    {
        //For studios inormation
        var requestStudio = new XMLHttpRequest();
        requestStudio.open("POST","https://localhost/Group-16-COS221-PA-5/api/movie_api_v3.php");
        requestStudio.setRequestHeader("Content-Type", "application/json");

        //Request to the API
        requestStudio.send(JSON.stringify(
        {
            type: "studios",
            api_key: localStorage.getItem("api_key")
        }));


        requestStudio.onload = function()
        {   
            
            if (!this.responseText) return;
            var response = JSON.parse(requestStudio.responseText);

            if (response.status === 'success') 
            {
                //successful response from the API. 
                for (let i = 1; i < 50; i++) 
                {
                    createListing2(i, response);
                }  
            } 
            else 
            {
                //unsuccessful response from the API.
                //Return the error from the API to the user.
                alert(response.message);
            }
        }
    });

    function createListing2(index, response) 
    {
        const imageRequest = new XMLHttpRequest();

        // API that we using for studio images
        imageRequest.open("GET", `https://api.themoviedb.org/3/company/${index}/images`);
        imageRequest.setRequestHeader('accept', 'application/json');

        //API key that we use for images throughoout the website
        imageRequest.setRequestHeader('Authorization', 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJmMDhjNzk1ZDlmY2JmMzczZDMyZGZhNzVlZDIzYjUzNyIsInN1YiI6IjY2NGNhODAyZmQ0MWQ1M2NhZmYyZGRlMyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.gkyF7TnTPIp4G-J6gMfFuETtXZe6TSw1wk7Yip9zt2U');
        
        imageRequest.onload = function() 
        {
            var imageresponse = JSON.parse(imageRequest.responseText);

            //Check if the API retuned an image (some of the company indexs do not have IDs)
            if (imageresponse.id !== null)
            { 
                if (imageresponse.logos.length !== 0) 
                {
                    //Create all the elements that are related to each studio.
                    var spanContainer = document.getElementById("studios");

                    const tile = document.createElement('div');
                    tile.classList.add('tile'); 
                    spanContainer.appendChild(tile);
                    
                    const image = document.createElement('img');
                    image.classList.add('movieImage');
                    image.src = "https://image.tmdb.org/t/p/original/" + imageresponse.logos[0].file_path;
                    tile.appendChild(image);

                    //CEO of the studio
                    const CeoNames = document.createElement('p');
                    CeoNames.innerText = "CEO: " + response.data[0][index].first_name + " " +  response.data[0][index].last_name;
                    tile.appendChild(CeoNames);

                    const name = document.createElement('p');
                    name.innerText = "Studio Name: " + response.data[0][index].name;
                    tile.appendChild(name);

                    //Contact inormation:
                    const Address = document.createElement('p');
                    Address.innerText = "Address: " + response.data[0][index].street_number 
                    + " " + response.data[0][index].street + " " + response.data[0][index].city
                    + " " + response.data[0][index].province + " " + response.data[0][index].country;
                    tile.appendChild(Address);

                    const phone = document.createElement('p');
                    phone.innerText = "Phone numbers : " + response.data[0][index].phone; 
                    tile.appendChild(phone);

                    const email = document.createElement('p');
                    email.innerText = "Email : " + response.data[0][index].email; 
                    tile.appendChild(email);
                }
            }
            else
            {
                console.log("Resource could not be found");
            }
        }

        imageRequest.send();
    }
}
    

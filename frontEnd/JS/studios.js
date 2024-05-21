document.addEventListener("DOMContentLoaded",function()
{

    var requestStudio = new XMLHttpRequest();
    //http://localhost/Group-16-COS221-PA-5/frontEnd/login.php
    requestStudio.open("POST","http://localhost/Group-16-COS221-PA-5/frontEnd/movie_api_v2.php");
    requestStudio.setRequestHeader("Content-Type", "application/json");

    requestStudio.send(JSON.stringify(
    {
        type: "studio",
        // apikey: ""
    }));

    requestStudio.onload = function()
    {   
        
        if (!this.responseText) return;
        var response = JSON.parse(requestStudio.responseText);

        console.log(response);
    
        if (response.status === 'success') 
        { 
            for (let i = 0; i < response.data.length; i++) 
            {
                createListing2(i, response);
            }  
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
        const Lisitingcontainer = document.createElement('div');
  
        const Listing = document.createElement('div');
        Listing.classList.add('listing');
        Listing.id =`Listing${index + 1}`;
      
        // const imageRequest = new XMLHttpRequest();
        // imageRequest.open("GET", `https://wheatley.cs.up.ac.za/api/getimage?listing_id=${response.data[index].id}`, false);
      
        // imageRequest.onload = function() 
        // {
        //   const imageResponse = JSON.parse(this.responseText);
        //   if (imageResponse.status === 'success') 
        //   {

            const name = document.createElement('p');
            price.innerText = "Studio Name:" + response.name;
            Listing.appendChild(price);

            const imageLink = document.createElement('a');
            imageLink.id = `Listing${index + 1}image`;
            imageLink.href = response.data[index].url;
            Listing.appendChild(imageLink);
  
            const image = document.createElement('img');
            image.classList.add('listing');
            image.src = imageResponse.data[0];
            image.alt = `Listing ${index + 1} image`;
            image.href = response.data[index].url;
            imageLink.appendChild(image);
      
            const Listingtitle = document.createElement('h2');
            Listingtitle.id = `Listing ${index + 1}title`;
            Listingtitle.innerText = response.data[index].title;
            Listing.appendChild(Listingtitle);
  
            const Location = document.createElement('p');
            Location.id = `Location${index}`;
            Location.innerText = "Location: " + response.data[index].location;
            Listing.appendChild(Location);
  
            const price = document.createElement('p');
            price.id = `price${index}`;
            price.innerText = "Price: R" + response.data[index].price;
            Listing.appendChild(price);
  
            const bedrooms = document.createElement('p');
            bedrooms.id = `bedrooms${index}`;
            bedrooms.innerText = "Bedrooms :" + response.data[index].bedrooms;
            Listing.appendChild(bedrooms);
  
            const bathrooms = document.createElement('p');
            bathrooms.id = `bathrooms${index}`;
            bathrooms.innerText = "Bathrooms :" + response.data[index].bathrooms;
            Listing.appendChild(bathrooms);
  
            const type = document.createElement('p');
            type.id = `type${index}`;
            type.innerText = "Property is for : " + response.data[index].type;
            Listing.appendChild(type);
      
            const ListingButton = document.createElement('button');
            ListingButton.id = `${index + 1}`;
            ListingButton.innerText = "More Information";
            Listing.appendChild(ListingButton);
  
            ListingButton.addEventListener('click', function()
            {
              var buttonID = ListingButton.id;
              console.log(buttonID);
              const url = `view.html?id=${buttonID}`;
              // ListingButton.removeAttribute("href");
              ListingButton.setAttribute("data-url", url);
              window.open(url, "_Blank");
            });
  
            const ListingLinkAdd = document.createElement('a');
            ListingLinkAdd.id = `Listing${index + 1}LinkAdd`;
            ListingLinkAdd.href = "Favourites.html";
            Listing.appendChild(ListingLinkAdd);
      
            const ListingAddToFav = document.createElement('button');
            ListingAddToFav.id = `Listings${index + 1}AddToFavButton`;
            ListingAddToFav.innerText = "Add to Favourites"; 
            ListingLinkAdd.appendChild(ListingAddToFav);
      
            document.body.appendChild(Listing);
  
        //   }

        // };
      
        // imageRequest.send();
    }
    

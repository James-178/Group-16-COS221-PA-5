//index.js
//makes post requests to the API using XMLHttpRequests to populates movies on the titles page

if(!localStorage.hasOwnProperty("api_key")){
    window.location.href = "login.php";
    
}else{
    //global variables
    let genres = [];
    let lang = [];
    //populating languages
    const langaugeDataReq = new XMLHttpRequest();
    langaugeDataReq.onload = function(){ 
        if(this.status === 200){
            const res = JSON.parse(this.response);
            if(res.status == "success"){
                const d = res.data;
                const languages = d.language;
                //creating each langauge element in the dropdown list
                languages.forEach(language => {
                    const container = document.createElement('label');
                    container.className = 'container';
                  
                    const text = document.createTextNode(language);
                    container.appendChild(text);
                  
                    const input = document.createElement('input');
                    input.type = 'checkbox';
                    input.id = language;
                    lang.push(input);
                    container.appendChild(input);
                    
                    const checkmark = document.createElement('span');
                    checkmark.className = 'checkmark';
                    container.appendChild(checkmark);
                  
                    document.getElementById('lang').appendChild(container);
                  });
            }
        }
    }
    
    let langaugeParams = {
        
        type : "GetLanguages",
        api_key : localStorage.getItem("api_key")
    }
    //opening and sending the request to the api
    langaugeDataReq.open("POST", "https://localhost/Group-16-COS221-PA-5/api/movie_api_v3.php");
    langaugeDataReq.send(JSON.stringify(langaugeParams));

    //populating genres
    const genreDataReq = new XMLHttpRequest();
    genreDataReq.onload = function(){
        if(this.status === 200){
            const res = JSON.parse(this.response);
            if(res.status == "success"){
                const d2 = res.data;
                const languages2 = d2.genres;

                //creating each langauge element in the dropdown list
                languages2.forEach(language => {
                    const container = document.createElement('label');
                    container.className = 'container';
                  
                    const text = document.createTextNode(language);
                    container.appendChild(text);
                  
                    const input = document.createElement('input');
                    input.type = 'checkbox';
                    input.id = language;
                    genres.push(input);
                    container.appendChild(input);
                  
                    const checkmark = document.createElement('span');
                    checkmark.className = 'checkmark';
                    container.appendChild(checkmark);
                  
                    document.getElementById('genre').appendChild(container);
                  });
            }
        }
    }

    let genreParams = {
        type : "GetGenres",
        api_key : localStorage.getItem("api_key")
    }

    genreDataReq.open("POST", "https://localhost/Group-16-COS221-PA-5/api/movie_api_v3.php");
    genreDataReq.send(JSON.stringify(genreParams));

    //function to create and send the data request for listing, proccess the data and create the tiles
    //second variable not used, to scared to remove it
    function dataReq(params, ind){
        const titlesDataReq = new XMLHttpRequest();
        titlesDataReq.onload = function(){
            if(this.status == 200){

                res = JSON.parse(this.responseText);
                let data = res.data;
                let container = document.getElementById("listings");
                container.innerHTML = "";
                let index = ind;
                data.forEach(movie => {
                    const tile = document.createElement('div');
                    tile.className = 'tile';
                    tile.addEventListener("click", function(){
                        window.location.href = "view.php?"+movie[0].title_id;
                    })

                    const img = document.createElement('img');
                    const imageRequest = new XMLHttpRequest();
                    
                    imageRequest.onload = function(){//send request for image to https://image.tmdb.org
                        if(this.status === 200){
                            var imageresponse = JSON.parse(imageRequest.responseText);
                            if (imageresponse.id !== null){                 
                                if (imageresponse.posters[0].length !== 0) {
                                    img.src = "https://image.tmdb.org/t/p/w500/" + imageresponse.posters[0].file_path;
                                    img.width = 300;
                                    img.height = 300;
                                    img.alt = 'image of movie';
                                    img.className = 'movieImage';
                                }
                            }
                        }else{  
                            img.src = 'img/simpleEdit.jpg';//if no image default to the logo
                            img.width = 300;
                            img.height = 300;
                            img.alt = 'image of movie';
                            img.className = 'movieImage';
                                
                        }
                        
                    }
                    imageRequest.open('GET', `https://api.themoviedb.org/3/movie/${movie[0].title_id}/images`);
                    //setting headers and api_key for the images
                    imageRequest.setRequestHeader('accept', 'application/json');
                    imageRequest.setRequestHeader('Authorization', 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJmMDhjNzk1ZDlmY2JmMzczZDMyZGZhNzVlZDIzYjUzNyIsInN1YiI6IjY2NGNhODAyZmQ0MWQ1M2NhZmYyZGRlMyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.gkyF7TnTPIp4G-J6gMfFuETtXZe6TSw1wk7Yip9zt2U');
                    imageRequest.send();
                    index++;
                    tile.appendChild(img);
                
                    const p = document.createElement('p');
                    p.innerHTML = `
                        Title: ${movie[0].name}<br>
                        Release Year: ${movie[0].release_year}<br>
                        Genre: ${movie[0].genres}<br>
                        Language: ${movie[0].language_name}<br>
                        IMDB-Rating: ${movie[0].IMDB_rating}
                    `;
                    tile.appendChild(p);
                
                    listings.appendChild(tile);
                });
            
            }
        }
        titlesDataReq.open("POST", "https://localhost/Group-16-COS221-PA-5/api/movie_api_v3.php");
        titlesDataReq.send(JSON.stringify(params));
    }

    //creating titleParams
    let titleParams = {
        type:"GetAllTitles",
        api_key : localStorage.getItem("api_key"),
        limit : 20
    }
    //initial request
    dataReq(titleParams, 2);

    //more global variables
    let moviesFilter = document.getElementById('movie-filter');
    let sereisFilter = document.getElementById('series-filter');

    let imdb1 = document.getElementById("imdb1");
    let imdb2 = document.getElementById("imdb2");
    let imdb3 = document.getElementById("imdb3");
    let imdb4 = document.getElementById("imdb4");
    let imdb5 = document.getElementById("imdb5");

    //select only one imdb rating range
    imdb1.addEventListener("click", function(){
        imdb2.checked = false;
        imdb3.checked = false;
        imdb4.checked = false;
        imdb5.checked = false;
    });
    imdb2.addEventListener("click", function(){
        imdb1.checked = false;
        imdb3.checked = false;
        imdb4.checked = false;
        imdb5.checked = false;
    });
    imdb3.addEventListener("click", function(){
        imdb2.checked = false;
        imdb1.checked = false;
        imdb4.checked = false;
        imdb5.checked = false;
    });
    imdb4.addEventListener("click", function(){
        imdb1.checked = false;
        imdb2.checked = false;
        imdb3.checked = false;
        imdb5.checked = false;
    });
    imdb5.addEventListener("click", function(){
        imdb2.checked = false;
        imdb3.checked = false;
        imdb4.checked = false;
        imdb1.checked = false;
    });

    //filter only movies  
    moviesFilter.addEventListener("click", function(){
        let movieParams = {
            type:"GetAllTitles",
            api_key:localStorage.getItem("api_key"),
            limit : 20,
            search : {
                is_movie : 1
            }
        }
        dataReq(movieParams, 62);
    });

    //filter only series
    sereisFilter.addEventListener("click", function(){
        let seriesParams = {
            type:"GetAllTitles",
            api_key : localStorage.getItem("api_key"),
            limit : 20,
            search : {
                is_movie : 0
            }
        }
        dataReq(seriesParams, 100);
    });

    //only one of title/rating checked at a time in sort
    let titleCheck = document.getElementById("title-check");
    let ratingCheck = document.getElementById("rating-check");

    titleCheck.addEventListener("click", function(){
        if(ratingCheck.checked){
            ratingCheck.checked = false;
        }
    });

    ratingCheck.addEventListener("click", function(){
        if(titleCheck.checked){
            titleCheck.checked = false;
        }
    });

    //on click of filter filters based on selected filters 
    let filter = document.getElementById("filter");
    let searchTitle = document.getElementById("search-bar");
    
    filter.addEventListener("click", function(){
        //base params
        let filterParams = {
            type:"GetAllTitles",
            api_key:localStorage.getItem("api_key"),
            limit : 20,
            search : {
                
            }
        }

        //sort by rating/title
        if(ratingCheck.checked){ 
            filterParams.sort = "IMDB_rating";
            filterParams.order = "DESC";
        }else if(titleCheck.checked){
            filterParams.sort = "name";
            filterParams.order = "ASC";
        }

        //find the language that is selected
        let i = 1;
        lang.forEach(box =>{
            if(box.checked){
                filterParams.search.language_id = i;
            }
            i++;
        });

        //find the genre that is selected
        i = 1;
        genres.forEach(box =>{
            if(box.checked){
                filterParams.search.genre = box.id;
            }
            i++;
        });

        //max and min imdb
        if(imdb1.checked){
            filterParams.search.imdb_min = 0;
            filterParams.search.imdb_max = 2;
        }
        if(imdb2.checked){
            filterParams.search.imdb_min = 2;
            filterParams.search.imdb_max = 4;
        }
        if(imdb3.checked){
            filterParams.search.imdb_min = 4;
            filterParams.search.imdb_max = 6;
        }
        if(imdb4.checked){
            filterParams.search.imdb_min = 6;
            filterParams.search.imdb_max = 8;
        }
        if(imdb5.checked){
            filterParams.search.imdb_min = 8;
            filterParams.search.imdb_max = 10;
        }

        //check if there is a search
        if(searchTitle.value != ""){
            filterParams.search.name = searchTitle.value;
        }
        
        //send the request, the second variable is now useless
        dataReq(filterParams, Math.floor(Math.random() * 801) + 200);
    });

}
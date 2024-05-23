// if(!localStorage.hasOwnProperty("api_key")){
//     window.location.href = "login.php";
    
// }else{
    let genres = [];
    let lang = [];
    const langaugeDataReq = new XMLHttpRequest();
    langaugeDataReq.onload = function(){
        if(this.status === 200){
            const res = JSON.parse(this.response);
            if(res.status == "success"){
                const d = res.data;
                const languages = d.language;
               // console.log(languages);
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
        api_key : "1L9v3SkNkKxUcARx3YxL"//change to local storage
    }
    langaugeDataReq.open("POST", "https://localhost/prac5/api/movie_api_v2.php");
    langaugeDataReq.send(JSON.stringify(langaugeParams));


    const genreDataReq = new XMLHttpRequest();
    genreDataReq.onload = function(){
        if(this.status === 200){
            const res = JSON.parse(this.response);
            if(res.status == "success"){
                const d2 = res.data;
                const languages2 = d2.genres;
               // console.log(languages2);
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
        api_key : "1L9v3SkNkKxUcARx3YxL" //change to local storage
    }

    genreDataReq.open("POST", "https://localhost/prac5/api/movie_api_v2.php");
    genreDataReq.send(JSON.stringify(genreParams));

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
                    
                    imageRequest.onload = function() 
                    {
                        if(this.status === 200){
                            var imageresponse = JSON.parse(imageRequest.responseText);
                            if (imageresponse.id !== null)
                            { 
                                    
                                //console.log(imageresponse);
                
                                if (imageresponse.posters[0].length !== 0) 
                                {
                                    img.src = "https://image.tmdb.org/t/p/w500/" + imageresponse.posters[0].file_path;
                                    //img.src = 'img/ironman.jpg';
                                    img.width = 300;
                                    img.height = 300;
                                    img.alt = 'image of movie';
                                    img.className = 'movieImage';
                                }
                            }
                        }else{  
                            img.src = 'img/simpleEdit.jpg';
                            img.width = 300;
                            img.height = 300;
                            img.alt = 'image of movie';
                            img.className = 'movieImage';
                                
                        }
                        
                    }
                    imageRequest.open('GET', `https://api.themoviedb.org/3/movie/${movie[0].title_id}/images`);
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
                
                    const btn = document.createElement('div');
                    btn.className = 'btn';
                    btn.innerHTML = 'Add to Watchlist';
                    tile.appendChild(btn);
                
                    listings.appendChild(tile);
                });
            
            }
        }
        titlesDataReq.open("POST", "https://localhost/prac5/api/movie_api_v2.php");
        titlesDataReq.send(JSON.stringify(params));
    }

    let titleParams = {
        type:"GetAllTitles",
        api_key:"1MFEaA8FrFVRiMBdVdFB",
        limit : 20
    }

    dataReq(titleParams, 2);

    let moviesFilter = document.getElementById('movie-filter');
    let sereisFilter = document.getElementById('series-filter');

    let imdb1 = document.getElementById("imdb1");
    let imdb2 = document.getElementById("imdb2");
    let imdb3 = document.getElementById("imdb3");
    let imdb4 = document.getElementById("imdb4");
    let imdb5 = document.getElementById("imdb5");

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


    moviesFilter.addEventListener("click", function(){
        let movieParams = {
            type:"GetAllTitles",
            api_key:"1MFEaA8FrFVRiMBdVdFB",
            limit : 20,
            search : {
                is_movie : 1
            }
        }
        dataReq(movieParams, 62);
    });

    sereisFilter.addEventListener("click", function(){
        let seriesParams = {
            type:"GetAllTitles",
            api_key:"1MFEaA8FrFVRiMBdVdFB",
            limit : 20,
            search : {
                is_movie : 0
            }
        }
        dataReq(seriesParams, 100);
    });

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

    let filter = document.getElementById("filter");
    let searchTitle = document.getElementById("search-bar");
    console.log(searchTitle.value);
    filter.addEventListener("click", function(){
        let filterParams = {
            type:"GetAllTitles",
            api_key:"1MFEaA8FrFVRiMBdVdFB",
            limit : 20,
            search : {
                
            }
        }

        if(ratingCheck.checked){
            filterParams.sort = "IMDB_rating";
            filterParams.order = "DESC";
        }else if(titleCheck.checked){
            filterParams.sort = "name";
            filterParams.order = "ASC";
        }

        let i = 1;
        lang.forEach(box =>{
            if(box.checked){
                filterParams.search.language_id = i;
            }
            i++;
        });

        i = 1;
        genres.forEach(box =>{
            if(box.checked){
                filterParams.search.genre = box.id;
            }
            i++;
        });

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

        if(searchTitle.value != ""){
            filterParams.search.name = searchTitle.value;
        }
        console.log(filterParams);
        dataReq(filterParams, Math.floor(Math.random() * 801) + 200);
    });

// }
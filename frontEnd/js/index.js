// if(!localStorage.hasOwnProperty("api_key")){
//     window.location.href = "login.php";
    
// }else{
    const langaugeDataReq = new XMLHttpRequest();
    langaugeDataReq.onload = function(){
        if(this.status === 200){
            const res = JSON.parse(this.response);
            if(res.status == "success"){
                const d = res.data;
                const languages = d.language;
                console.log(languages);
                languages.forEach(language => {
                    const container = document.createElement('label');
                    container.className = 'container';
                  
                    const text = document.createTextNode(language);
                    container.appendChild(text);
                  
                    const input = document.createElement('input');
                    input.type = 'checkbox';
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
        
        "type" : "GetLanguages",
        "api_key" : "1L9v3SkNkKxUcARx3YxL"//change to local storage
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
                console.log(languages2);
                languages2.forEach(language => {
                    const container = document.createElement('label');
                    container.className = 'container';
                  
                    const text = document.createTextNode(language);
                    container.appendChild(text);
                  
                    const input = document.createElement('input');
                    input.type = 'checkbox';
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
        
        "type" : "GetGenres",
        "api_key" : "1L9v3SkNkKxUcARx3YxL" //change to local storage
    }
    genreDataReq.open("POST", "https://localhost/prac5/api/movie_api_v2.php");
    genreDataReq.send(JSON.stringify(genreParams));
// }
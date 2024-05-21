const button = document.getElementById("login-btn");


//localStorage.removeItem("apiKey");
//dmtest@plswork.com
//LoveYou3000!
button.addEventListener("click", function() {
    const email = document.getElementById("email");
    const password = document.getElementById("password");
    const error = document.getElementById("error");
    error.innerHTML = "";
    const loginDataReq = new XMLHttpRequest();

    loginDataReq.onload = function(){
        if(this.status === 200){
            const res = JSON.parse(this.response);

            if(res.status != "success"){
                const d = res.data;
                for (let index = 0; index < d.length; index++) {
                    const p = document.createElement("p");
                    p.innerHTML = d[index];
                    error.appendChild(p); 
                }
            }else if(res.status == "success"){
                const apiKey = res.data[0].apiKey;
                localStorage.setItem("apiKey", apiKey);
                const p2 = document.createElement("p");
                p2.innerHTML = "Successully registered";

                const getThemeReq = new XMLHttpRequest();

                getThemeReq.onload = function(){
                    const themeRes = JSON.parse(this.response);
                    if(res.status == "success"){
                        const themeData = themeRes.data;
                        localStorage.setItem("darkmode", themeData[0].theme);
                    }
                }

                const themeFilter = {
                    "type" : "GetTheme",
                    "apiKey" : localStorage.getItem("apiKey")
                }

                getThemeReq.open("POST", "https://localhost/Practicals/api.php", false);
                getThemeReq.send(JSON.stringify(themeFilter));

                if(!localStorage.hasOwnProperty("darkmode")){
                    localStorage.setItem("darkmode", 0);
                }

                const setDarkmodeReq = new XMLHttpRequest();
                const params = {
                    "type" : "Darkmode",
                    "darkmode" : localStorage.getItem("darkmode"),
                    "apiKey" : localStorage.getItem("apiKey")
                }

                setDarkmodeReq.open("POST", "https://localhost/Practicals/api.php");
                setDarkmodeReq.send(JSON.stringify(params));

                const getFiltersReq = new XMLHttpRequest();

                getFiltersReq.onload = function(){
                    const filterRes = JSON.parse(this.response);
                    if(res.status == "success"){
                        const filterData = filterRes.data;
                        localStorage.setItem("filterPrice", filterData[0].filterPrice);
                        localStorage.setItem("filterBedrooms", filterData[0].filterBedrooms);
                        localStorage.setItem("filterBathrooms", filterData[0].filterBathrooms);
                    }
                }

                const paramsilter = {
                    "type" : "GetPreferences",
                    "apiKey" : localStorage.getItem("apiKey")
                }

                getFiltersReq.open("POST", "https://localhost/Practicals/api.php", false);
                getFiltersReq.send(JSON.stringify(paramsilter));

                const getFavouritesReq = new XMLHttpRequest();

                getFavouritesReq.onload = function(){
                    const favRes = JSON.parse(this.response);
                    if(res.status == "success"){
                        const favData = favRes.data;
                        let arr;
                        const intArray = [];
                        if(favData[0].favourites != ''){
                            arr = favData[0].favourites.split(/,/);
                            
                            for (let i = 0; i < arr.length; i++) {
                                intArray.push(parseInt(arr[i]));
                            }
                        }

                        localStorage.setItem("favs", JSON.stringify(intArray));
                    }
                }

                const paramsFavs = {
                    "type" : "getFavourite",
                    "apiKey" : localStorage.getItem("apiKey")
                }

                getFavouritesReq.open("POST", "https://localhost/Practicals/api.php", false);
                getFavouritesReq.send(JSON.stringify(paramsFavs));

                email.value = "";
                password.value = "";     
                window.location.href = "index.php";
            }
        }else{
            res = JSON.parse(this.response);
            if(res.status != "success"){
                const d = res.data;
                for (let index = 0; index < d.length; index++) {
                    const p = document.createElement("p");
                    p.innerHTML = d[index];
                    error.appendChild(p); 
                }
            }
        }
    }


    const params = {
        "type" : "login",
        "email" : email.value,
        "password" : password.value,
    }
    loginDataReq.open("POST", "https://localhost/Practicals/api.php");
    loginDataReq.send(JSON.stringify(params));
})
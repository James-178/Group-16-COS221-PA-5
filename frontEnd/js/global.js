//global.js
//Handles the local storage and changing of the nav bar

//changing login/logout/register li elements when a user logs in
if(localStorage.hasOwnProperty("api_key")){
    document.getElementById('login-li').style.display = 'none';
    document.getElementById('register-li').style.display = 'none';
    document.getElementById('logout-li').style.display = 'inline';
}

//changing admin li element if user is an admin
let admin = document.getElementById("admin-li");
if(localStorage.hasOwnProperty("admin")){
    if(localStorage.getItem("admin") == 1){
        admin.style.display = 'inline';
    }
}

//changing login/logout/register li elements when a user logs in
//deallocating local storage items
let logout = document.getElementById("logout-li");
logout.addEventListener("click", function(){
    if(localStorage.hasOwnProperty("api_key")){
        document.getElementById('login-li').style.display = 'inline';
        document.getElementById('register-li').style.display = 'inline';
        document.getElementById('logout-li').style.display = 'none';
        localStorage.removeItem("api_key");
    }

    if(localStorage.hasOwnProperty("admin")){
        localStorage.removeItem("admin");
    }
});
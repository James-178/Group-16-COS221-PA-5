//admin.js
//Requires admin permissions to access

if(!localStorage.hasOwnProperty("api_key")){//is logged in
    window.location.href = "login.php";
}else if(!localStorage.hasOwnProperty("admin")){
    window.location.href = "login.php";
}else if(localStorage.getItem("admin") == 0){//logged in but not an admin
    window.location.href = "index.php";
}
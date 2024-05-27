//login.js
//allows a user to login

const button = document.getElementById("login-btn");

//send request when login button is clicked, user must be registered
button.addEventListener("click", function() {
    //getting the values of the inputs
    const email = document.getElementById("email");
    const password = document.getElementById("password");
    const error = document.getElementById("error");
    error.innerHTML = "";
    const loginDataReq = new XMLHttpRequest();

    //processing the response
    loginDataReq.onload = function(){
        if(this.status === 200){
            const res = JSON.parse(this.response);
            if(res.status != "success"){//unsucessful login
                const d = res.data;
                const p = document.createElement("p");
                p.innerHTML = d;
                error.appendChild(p); 
              
            }else if(res.status == "success"){//successful login
                const apiKey = res.data.apikey;
                const admin = res.data.admin;
                localStorage.setItem("api_key", apiKey);
                localStorage.setItem("admin", admin);

   
                window.location.href = "index.php";//change to listings
            }
        }else{//handling an error
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
    //creating JSON object to send
    const params = {
        "type" : "Login",
        "email" : email.value,
        "password" : password.value,
    }
    //opening and sending the response to the api
    loginDataReq.open("POST", "https://localhost/Group-16-COS221-PA-5/api/movie_api_v3.php");
    loginDataReq.send(JSON.stringify(params));
})
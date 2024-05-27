//register.js
//allows users to register

const button = document.getElementById("register-btn");

//send request when register button is clicked 
button.addEventListener("click", function() {
    const name = document.getElementById("name");
    const surname = document.getElementById("surname");
    const dob = document.getElementById("dob");
    const email = document.getElementById("email");
    const password = document.getElementById("password");
    const error = document.getElementById("error");

    const loginDataReq = new XMLHttpRequest();
    
    //process the response
    loginDataReq.onload = function(){
        if(this.status === 200){
            res = JSON.parse(this.response);

            if(res.status != "success"){//unsuccessul register
                const d = res.data;
                const p = document.createElement("p");
                p.innerHTML = d;
                error.appendChild(p); 
                
            }else if(res.status == "success"){//successful register
                const p2 = document.createElement("p");
                p2.innerHTML = "Successully registered";
                name.value = "";
                surname.value = "";
                email.value = "";
                password.value = "";     
                window.location.href = "login.php";//user must login after registering
            }
        }else{//unsuccessful register
            res = JSON.parse(this.response);
            const d = res.data;
            
            const p = document.createElement("p");
            p.innerHTML = d;
            error.appendChild(p); 
        }
    }
    //create parameters 
    const params = {
        "type" : "Register",
        "first_name" : name.value,
        "last_name" : surname.value,
        "dob" : dob.value.replace(/-/g, "/"),
        "email" : email.value,
        "password" : password.value,
    }

    //opening and sending the response to the api
    loginDataReq.open("POST", "https://localhost/Group-16-COS221-PA-5/api/movie_api_v3.php");
    loginDataReq.send(JSON.stringify(params));
})
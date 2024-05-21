const button = document.getElementById("register-btn");

//LoveYou3000!
button.addEventListener("click", function() {
    //remove apikey
    const name = document.getElementById("name");
    const surname = document.getElementById("surname");
    const dob = document.getElementById("dob");
    console.log(dob.value);
    const email = document.getElementById("email");
    const password = document.getElementById("password");
    const error = document.getElementById("error");

    const loginDataReq = new XMLHttpRequest();
    
    loginDataReq.onload = function(){
        if(this.status === 200){
            res = JSON.parse(this.response);

            if(res.status != "success"){
                const d = res.data;
                console.log(res.data);
               
                const p = document.createElement("p");
                p.innerHTML = d;
                error.appendChild(p); 
                
            }else if(res.status == "success"){
                console.log("here");
                const p2 = document.createElement("p");
                p2.innerHTML = "Successully registered";

                // document.getElementById('login-li').style.display = 'none';
                // document.getElementById('register-li').style.display = 'none';
                // document.getElementById('logout-li').style.display = 'block';

                // localStorage.setItem("filterPrice", 0);
                // localStorage.setItem("filterBedrooms", 0);
                // localStorage.setItem("filterBathrooms", 0);

                //const intArray = [];
                //localStorage.setItem("favs", JSON.stringify(intArray));


                name.value = "";
                surname.value = "";
                email.value = "";
                password.value = "";     
                window.location.href = "login.php";
            }
        }else{
            res = JSON.parse(this.response);
            console.log(res.data);
            const d = res.data;
            
            const p = document.createElement("p");
            p.innerHTML = d;
            error.appendChild(p); 
            
            
        }
    }

    const params = {
        "type" : "Register",
        "first_name" : name.value,
        "last_name" : surname.value,
        "dob" : dob.value.replace(/-/g, "/"),
        "email" : email.value,
        "password" : password.value,
    }


    loginDataReq.open("POST", "https://localhost/prac5/api/movie_api_v2.php");
    loginDataReq.send(JSON.stringify(params));
})
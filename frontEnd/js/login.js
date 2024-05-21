const button = document.getElementById("login-btn");


//localStorage.removeItem("apiKey");
//dmtest@plswork.com
//LoveYou3000!

button.addEventListener("click", function() {
    console.log("login js is running");
    const email = document.getElementById("email");
    const password = document.getElementById("password");
    const error = document.getElementById("error");
    error.innerHTML = "";
    const loginDataReq = new XMLHttpRequest();

    loginDataReq.onload = function(){
        console.log("onload ");
        if(this.status === 200){
            const res = JSON.parse(this.response);
            console.log(res);
            if(res.status != "success"){
                const d = res.data;
              //  for (let index = 0; index < d.length; index++) {
                    const p = document.createElement("p");
                    p.innerHTML = d;
                    error.appendChild(p); 
              //  }
            }else if(res.status == "success"){
                const apiKey = res.data.apikey;
                localStorage.setItem("api_key", apiKey);
                const p2 = document.createElement("p");
                p2.innerHTML = "Successully registered";



                // const getIndexReq= new XMLHttpRequest();
                // const paramsind = {
                //     "type" : "Login",
                //     "api_key" : localStorage.getItem("api_key")
                // }

                // getIndexReq.open("POST", "https://localhost/COS221_PA5/api/movie_api_v2.php", false);
                // getIndexReq.send(JSON.stringify(paramsind));

                // email.value = "";
                // password.value = "";     
                window.location.href = "index.php";
            }
        }else{
            res = JSON.parse(this.response);
            console.log(res);
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

    console.log(email.value);
    console.log(password.value);
    const params = {
        "type" : "Login",
        "email" : email.value,
        "password" : password.value,
    }
    loginDataReq.open("POST", "https://localhost/prac5/api/movie_api_v2.php");
    loginDataReq.send(JSON.stringify(params));
})
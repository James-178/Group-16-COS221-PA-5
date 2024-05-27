<!-- login.php -->

<!doctype html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/Style.css">
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;1,300&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/login-styles.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <title>Login</title>
</head>

<body>
<header>
    <?php include('nav.php'); ?>
    <section class = "login">
            <!-- <div class = "container"> -->
                
                <div class = "grid">
                    <div class = "card">
                        <h1 class = "register-header">LOGIN</h1>
                        <form id="login-form">
                            <div class="form-group">
                                <label for="email" class="login-label">E-mail:</label>
                                <input type = "text" id = "email" name = "email" class = "login-input" placeholder="youremail@gmail.com" value = "testemail@real.com" required><br>
                            </div>

                            <div class="form-group">
                                <label for="password" class="login-label">Password:</label>
                                <input type = "password" id = "password" name = "password" class = "login-input" value = "123Test?" required><br>
                            </div>

                            <div id = "error">
                    
                            </div>
                    
                                <button id = "login-btn" type="button" class = "submit">Login</button>
                        </form>
                        
                        <p class = "login-label">No account? <a style="color : rgb(66, 66, 66)" href="register.php"> Register here.</a></p>

                    </div>
                    
                </div>
            <!-- </div> -->
    </section>
</header>
<script src="js/login.js"></script>
<script src = "js/global.js"></script>
</body>
</html>

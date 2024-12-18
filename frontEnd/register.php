<!-- register.php -->

<!doctype html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/Style.css">
    <link rel="stylesheet" type="text/css" href="css/login-styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;1,300&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <title>Register</title>
</head>

<body>
<header>
    <?php include('nav.php'); ?>

    <section class = "login">
            <!-- <div class = "container"> -->
                
                <div class = "grid">
                    <div class = "card">
                    <h1 class = "register-header">Register</h1>
                        <form id="login-form">
                            <div class="form-group">
                                <label for="name" class="login-label">Name:</label>
                                <input type = "text" id = "name" name = "name" class = "login-input" placeholder="Tony" value = "Tony" required><br>
                            </div>

                            <div class="form-group">
                                <label for="surname" class="login-label">Surname:</label>
                                <input type = "text" id = "surname" name = "surname" class = "login-input" placeholder="Stark" value="Stark" required><br>
                            </div>

                            <div class="form-group">
                                <label for="email" class="login-label">E-mail:</label>
                                <input type = "text" id = "email" name = "email" class = "login-input" placeholder="TonyStark@gmail.com" value="TonyStark@gmail.com" required><br>
                            </div>

                            <div class="form-group">
                                <label for="dob" class="login-label">Date of Birth:</label>
                                <input type = "date" id = "dob" name = "dob" class = "login-input" required><br>
                            </div>

                            <div class="form-group">
                                <label for="password" class="login-label">Password:</label>
                                <input type = "password" id = "password" name = "password" class = "login-input" value = "LoveYou3000!" required><br>
                            </div>

                            <div id = "error">
                    
                            </div>
                    
                            <button id = "register-btn" type="button" class = "submit">Register</button>
                        </form>
                        
                        <p class = "login-label">Already have an account? <a style="color : rgb(66, 66, 66)" href="login.php">Login here.</a></p>

                    </div>
                    
                </div>
            <!-- </div> -->
        </section>
</header>
<script src = "js/register.js"></script>
<script src = "js/global.js"></script>
</body>
</html>

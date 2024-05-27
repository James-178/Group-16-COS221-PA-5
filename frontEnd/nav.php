<!-- nav.php -->
<!-- All the navigation in one place -->

<nav class="sticky">
    <div class="row">
        <img src="img/simpleEdit.jpg" width="100" height="100" alt="Website Logo" class="logo"/>
        <ul class="main-nav">
            <li><a href="index.php">Titles</a></li>
            <li><a href="studios.php">Studios</a></li>
            <li><a href="recommend.php">Recommend</a></li>
            <!-- admin and logout tabs disabled until user logs in -->
            <li id="admin-li" style="display: none;"><a href="admin.php">Admin</a></li>
            <li id="logout-li" style="display: none;"><a href="login.php" id = "logout">Logout</a></li> 
            <li><a id = "register-li" href="register.php">Register</a></li>
            <li><a id = "login-li" class="current" href="login.php">Login</a></li>
            
        </ul>
    </div>
</nav>
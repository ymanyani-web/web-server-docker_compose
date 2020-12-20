<?php
session_start();
if(isset($_SESSION['user']))
{
    header('Location: view/gallery.php'); 
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Welcome</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="css/my_style.css">
        <link rel="stylesheet" type="text/css" href="css/admin.css">
    </head>
    <body>
    <header id="header">
    <div class="container-fluid">
        
        <div id="logo" class="pull-left">
            <h1><a href="view/camagru.php" class="scrollto">Camagru</a></h1>
        </div>

        <nav id="nav-menu-container">
            <ul class="nav-menu">
                <?php if (!empty($_SESSION['user'])) : ?>
                Welcome, <?php echo $_SESSION['user']; ?>
                <?php else : ?>
                Welcome Stranger
                <?php endif ?>
                <li><a href="view/gallery.php">Gallery</a></li>
                <li><a href="view/profile.php">Profile</a></li>
                <li class="menu-has-children"><a href="">Settings</a>
                    <ul>
                        <?php if (empty($_SESSION['user'])) : ?>
                        <li><a href="view/log_in.php">Login</a></li>
                        <li><a href="view/sign_up.php">Sign Up</a></li>
                        <?php endif; ?>
                        <?php if (!empty($_SESSION['user'])) : ?>
                        <li><a href="#">Modify my account</a></li>
                        <li><a href="controller/log_out.php" style="color: red;">Log out</a></li>
                        <?php endif; ?>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</header>
        <div class="content-w3ls">
            <div class="content-bottom">
                <h2>Welcome to Camagru</h2>
                <p>Already a member? <a href="view/log_in.php">Sign in</a></p>
                <p>New member? <a href="view/sign_up.php">Sign up</a></p>
            </div>
        </div>
    </body>
</html>
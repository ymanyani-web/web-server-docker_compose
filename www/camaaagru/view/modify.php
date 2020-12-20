<?php
session_start();
include     '../controller/connect_db.php';

if (isset($_SESSION['user']))
{
        $user = $_SESSION['user'];
        $reponse = $bdd->prepare('SELECT * FROM users WHERE username = :user');
        $reponse->execute(array(
        'user' => $user
        ));
        $donnees = $reponse->fetch();
}
     //echo "<script type='text/javascript'>alert('$t');</script>";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Welcome</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../css/my_style.css">
        <link rel="stylesheet" type="text/css" href="../css/admin.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    </head>
    <body>
        <header id="header">
            <div class="container-fluid">  
                <div id="logo" class="pull-left">
                    <h1><a href="../view/camagru.php" class="scrollto">Camagru</a></h1>
                </div>

                <nav id="nav-menu-container">
                    <ul class="nav-menu">
                        Welcome, <?php echo $_SESSION['user']; ?>
                        <li><a href="../view/gallery.php">Gallery</a></li>
                        <li><a href="../view/profile.php">Profile</a></li>
                        <li class="menu-has-children menu-active"><a href="">Settings</a>
                            <ul>
                                <?php if (empty($_SESSION['user'])) : ?>
                                <li><a href="../view/log_in.php">Login</a></li>
                                <li><a href="../view/sign_up.php">Sign Up</a></li>
                                <?php endif; ?>
                                <?php if (!empty($_SESSION['user'])) : ?>
                                <li><a href="../view/modify.php">Modify my account</a></li>
                                <li><a href="../controller/log_out.php" style="color: red;">Log out</a></li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </header>
        <div class="info">
            <div class="cadre">
                <h1>info</h1>
                <form action="../controller/modifier.php" method="post">
                    <!--username-->
                    <h2>username</h2>
                    <div class="field-group">
                        <span class="fa fa-user" aria-hidden="true"></span>
                        <div class="wthree-field">
                            <input type="text" name="user" placeholder="<?php echo $donnees['username']?>">
                        </div>
                    </div>
                    <!--email-->
                    <h2>email</h2>
                    <div class="field-group">
                        <span class="fa fa-user" aria-hidden="true"></span>
                        <div class="wthree-field">
                        <input type="email" name="email" placeholder="<?php echo $donnees['email']?>" >
                        </div>
                    </div>
                    <?php
                        if($donnees['random'] == "0999")
                        {
                            ?>
                                <h3>u have to validate ur email<h3>
                            <?php
                        }
                        ?>
                    <!--OK-->
                    <div class="wthree-field">
                        <input id="saveForm" name="signin-btn" type="submit" value="Modify" />
                    </div>
                </form>
            </div>
        </div>
        <div class="content-w3ls">
            <div class="content-bottom">
                <h1>modify my password</h1>
                <form action="../controller/modifier.php" method="post">
                    <!-- current password-->
                    <div class="field-group">
                        <span class="fa fa-user" aria-hidden="true"></span>
                        <div class="wthree-field">
                            <input type="password" name="pw0" placeholder="current password" required>
                        </div>
                    </div>
                    <!--password-->
                    <div class="field-group">
                        <span class="fa fa-user" aria-hidden="true"></span>
                        <div class="wthree-field">
                            <input type="password" name="pw1" placeholder="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                        </div>
                    </div>
                    <!--re pw-->
                    <div class="field-group">
                        <span class="fa fa-user" aria-hidden="true"></span>
                        <div class="wthree-field">
                            <input type="password" name="pw2" placeholder="retype password" required>
                        </div>
                    </div>
                    <!--OK-->
                    <div class="wthree-field">
                        <input id="saveForm1" name="signin-btn" type="submit" value="Modify" />
                    </div>
                </form><font color="red" size="5px"><?php echo $msg?></font>
            </div>
            <div>
            <input type="checkbox" id="checkbox" name="cmnt-mail" value="cmnt-mail" <?php echo ($donnees['cmnt-mail']==1 ? 'checked' : '');?> onclick="myFunction()"> active comment-mail
            </div>
            <script>
                function myFunction()
                {   
                    var checkBox = document.getElementById('checkbox');
                    if (checkBox.checked == true)
                        var tt = '1';
                    if (checkBox.checked == false)
                        var tt = '0';
                    if (confirm("Are you sure you want to _________?") == true)
                    {
                        $.ajax({
                            type:'post',
                            url:'../controller/em.php',
                            data:{tt: tt},
                        });
                    } 
                }
            </script>
        </div>
    </body>
</html>
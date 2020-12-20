<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Welcome</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../css/my_style.css">
        <link rel="stylesheet" type="text/css" href="../css/admin.css">
    </head>
    <body>
        <header id="header">
            <div class="container-fluid">  
                <div id="logo" class="pull-left">
                    <h1><a href="../view/camagru.php" class="scrollto">Camagru</a></h1>
                </div>

                <nav id="nav-menu-container">
                    <ul class="nav-menu">
                        <li><a href="../view/gallery.php">Gallery</a></li>
                        <li><a href="../view/profile.php">Profile</a></li>
                        <li class="menu-has-children menu-active"><a href="">Settings</a>
                            <ul>
                                <?php if (empty($_SESSION['user'])) : ?>
                                <li><a href="../view/log_in.php">Login</a></li>
                                <li><a href="../view/sign_up.php">Sign Up</a></li>
                                <?php endif; ?>
                                <?php if (!empty($_SESSION['user'])) : ?>
                                <li><a href="#">Modify my account</a></li>
                                <li><a href="../controller/log_out.php" style="color: red;">Log out</a></li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </header>
        <div class="msg">
        <?php
            if(isset($msg))
            {
                echo $msg;
            }
        ?>
        </div>
        <div class="content-w3ls">
            <div class="content-bottom">
                <h2>Sign up Here</h2>
                <form action="../controller/add.php" method="post">
                <!--username-->
                    <div class="field-group">
                        <span class="fa fa-user" aria-hidden="true"></span>
                        <div class="wthree-field">
                            <input type="text" name="username" placeholder="Username.." required>
                        </div>
                    </div>
                <!--email-->
                    <div class="field-group">
                        <span class="fa fa-user" aria-hidden="true"></span>
                        <div class="wthree-field">
                            <input type="email" name="email" placeholder="email.." required>
                        </div>
                    </div>
                <!--password-->
                    <div class="field-group">
                        <span class="fa fa-user" aria-hidden="true"></span>
                        <div class="wthree-field">
                            <input type="password" name="passwd"  id="psw" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                        </div>
                    </div>
                <!--password1-->
                    <div class="field-group">
                        <span class="fa fa-user" aria-hidden="true"></span>
                        <div class="wthree-field">
                            <input type="password" name="passwd1" placeholder="Retype Password" required>
                        </div>
                    </div>
                    <div class="wthree-field">
                        <input id="saveForm" name="signin-btn" type="submit" value="Sign up" />
                    </div>
                </form>
                <br><a href="../view/log_in.php">Already member!</a>
                </div>
            </div>
            <div id="message">
                <h3>Password must contain the following:</h3>
                <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
                <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
                <p id="number" class="invalid">A <b>number</b></p>
                <p id="length" class="invalid">Minimum <b>8 characters</b></p>
            </div>
            <style>
                
            </style>
            <script>
                var myInput = document.getElementById("psw");
                var letter = document.getElementById("letter");
                var capital = document.getElementById("capital");
                var number = document.getElementById("number");
                var length = document.getElementById("length");
                // When the user clicks on the password field, show the message box
                myInput.onfocus = function() {
                    document.getElementById("message").style.display = "block";
                }
                // When the user clicks outside of the password field, hide the message box
                myInput.onblur = function() {
                    document.getElementById("message").style.display = "none";
                }
                // When the user starts to type something inside the password field
                myInput.onkeyup = function() {
                    // Validate lowercase letters
                    var lowerCaseLetters = /[a-z]/g;
                    if(myInput.value.match(lowerCaseLetters)) {
                        letter.classList.remove("invalid");
                        letter.classList.add("valid");
                    } else {
                        letter.classList.remove("valid");
                        letter.classList.add("invalid");
                }
                // Validate capital letters
                var upperCaseLetters = /[A-Z]/g;
                if(myInput.value.match(upperCaseLetters)) {
                    capital.classList.remove("invalid");
                    capital.classList.add("valid");
                } else {
                    capital.classList.remove("valid");
                    capital.classList.add("invalid");
                }
                // Validate numbers
                var numbers = /[0-9]/g;
                if(myInput.value.match(numbers)) {
                    number.classList.remove("invalid");
                    number.classList.add("valid");
                } else {
                    number.classList.remove("valid");
                    number.classList.add("invalid");
                }
                // Validate length
                if(myInput.value.length >= 8) {
                    length.classList.remove("invalid");
                    length.classList.add("valid");
                } else {
                    length.classList.remove("valid");
                    length.classList.add("invalid");
                }
                }
            </script>

    </body>
</html>

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
        <!-- menu -->
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
                                <li><a href="../view/log_in.php">Login</a></li>
                                <li><a href="../view/sign_up.php">Sign Up</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </header>
        <!-- form -->
        <div class="content-w3ls">
            <div class="content-bottom">
                <h2>log in Here</h2>
                <form action="../controller/check.php" method="post">
                    <div class="field-group">
                        <span class="fa fa-user" aria-hidden="true"></span>
                        <div class="wthree-field">
                            <input type="text" id="usr" name="username" placeholder="Username.." required>
                        </div>
                        
                    </div>
                    <div class="field-group">
                        <span class="fa fa-user" aria-hidden="true"></span>
                        <div class="wthree-field">
                            <input type="password" name="passwd" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="wthree-field">
                        <input id="saveForm" name="signin-btn" type="submit" value="Sign in" />
                    </div>
                    <?php
                        if(isset($msg))
                        {
                            echo $msg;
                        }
                        if($_GET['t'] == "1")
                        {
                            echo "ur password has been modified, log in!!";
                        }
                        if($_GET['t'] == "2")
                        {
                            echo "ur username has been modified, log in!!";
                        }if($_GET['t'] == "3")
                        {
                            echo "ur email has been modified, check ur email before log in!!";
                        }
                    ?>
                </form>
                <br><a href='#' onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Forgotten account?</a>
                <a class="test" href='../view/sign_up.php'>sign up</a>
                </div>
            </div>
    </body>
    <div class="modal" id="frgt">
            <h2>Enter ur email to reset password</h2>
                <form action="../controller/f.php" method="post">
                        
                        <div class="field-group">
                        <span class="fa fa-user" aria-hidden="true"></span>
                        <div class="wthree-field">
                            <input type="email" name="email" placeholder="email" required>
                        </div>
                        
                    </div>
                    <div class="wthree-field">
                        <input type="submit" name="submit" value="Sent">
                    </div>
                </form>
                <div class="container" >
                    <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
                </div>
            </div>








<style>
body {font-family: Arial, Helvetica, sans-serif;}



.container {
  padding: 16px;
}


/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgba(0, 0, 0, 0.8);; /* Fallback color */
  background-color: rgba(0,0,4,0.8); /* Black w/ opacity */
  padding-top: 60px;
}

/* Modal Content/Box */
.modal-content {
  background-color: rgba(0, 0, 0, 0.4);
  margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
  border: 1px solid #888;
  width: 50%; /* Could be more or less, depending on screen size */
  padding-top: 20px;
  padding-bottom: 50px;
  padding-left: 50px;
  padding-right: 50px;
}





</style>



<div id="id01" class="modal">
  

                <form class="modal-content animate" action="../controller/f.php" method="post">
                     <h2>Enter ur email to reset password</h2>   
                        <div class="field-group">
                        <span class="fa fa-user" aria-hidden="true"></span>
                        <div class="wthree-field">
                            <input type="email" name="email" placeholder="email" required>
                        </div>
                        
                    </div>
                    <div class="wthree-field">
                        <input type="submit" name="submit" value="Sent">
                    </div>
            </form>
                
</div>

<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

















</html>
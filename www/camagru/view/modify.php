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
else
{
    ?>
    <script>
        alert("Log in first");
        window.history.back();
    </script>
    <?php
}
     //echo "<script type='text/javascript'>alert('$t');</script>";
?>





<!DOCTYPE HTML>

<html>
	<head>
		<title>Modifier</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="../assets/css/main.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	</head>
	<body>
		<div class="page-wrap">

			<!-- Nav -->
            <?php include("../includes/menu3.html"); ?>


			<!-- Main -->
				<section id="main">

					<!-- Header -->
						<header id="header">
							<div><span>Camagru</span></div>
						</header>

					<!-- Section -->
						<section class="ttt">



                            <div class="info">
                                <h1>info</h1>
                                <form action="../controller/modifier.php" method="post">
                                    <!--username-->
                                    <h2>username</h2>
                                    <span class="fa fa-user" aria-hidden="true"></span>
                                    <input type="text" name="user" placeholder="<?php echo $donnees['username']?>" maxlength="20">
                                    <!--email-->
                                    <h2>email</h2>
                                    <span class="fa fa-envelope-o" aria-hidden="true"></span>
                                    <input type="email" name="email" placeholder="<?php echo $donnees['email']?>" maxlength="60">

                                    <?php
                                        if($donnees['random'] == "0999")
                                        {
                                    ?>
                                            <h3>u have to validate ur email<h3>
                                    <?php
                                        }
                                    ?>
                                    <!--OK-->
                                    </br><input id="saveForm" name="signin-btn" type="submit" value="Modify" />
                                    <p><?php echo $msg; ?></p>
                                </form>
                            </div>
                                    </br>


                            <div class="info">
                                <h1>modify my password</h1>
                                <form action="../controller/modifier.php" method="post">
                                    <!-- current password-->
                                    <span class="fa fa-key" aria-hidden="true"></span>
                                    <input type="password" name="pw0" placeholder="current password" required maxlength="40">
                                    <!--password-->
                                    <span class="fa fa-key" aria-hidden="true"></span>
                                    <input type="password" name="pw1" placeholder="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" maxlength="40"required>
                                    <!--re pw-->
                                    <span class="fa fa-key" aria-hidden="true"></span>
                                    <input type="password" name="pw2" placeholder="retype password" maxlength="40" required>
                                    <!--OK-->
                                    </br><input id="saveForm1" name="signin-btn" type="submit" value="Modify" />
                                </form>
                            </div>


                            <div>
                                <font color="red" size="12px"><?php echo $msg?></font>
                            </div>

                            <div>
                                <input type="checkbox" id="checkbox" name="cmnt-mail" value="cmnt-mail" <?php echo ($donnees['cmnt-mail']==1 ? 'checked' : '');?> onclick="myFunction()"> active comment-mail
                            </div>

						</section>



					<!-- Footer -->
                    <?php include("../includes/footer.html"); ?>
				</section>
		</div>


	</body>
</html>












<script>
                function myFunction()
                {   
                    var checkBox = document.getElementById('checkbox');
                    if (checkBox.checked == true)
                        var tt = '1';
                    if (checkBox.checked == false)
                        var tt = '0';
                    if (confirm("Are you sure ?") == true)
                    {
                        $.ajax({
                            type:'post',
                            url:'../controller/em.php',
                            data:{tt: tt},
                        });
                    } 
                }
            </script>
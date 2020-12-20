<?php
session_start();
if(!empty($_SESSION['user']))
{
    header('Location: ../view/gallery.php');
}
?>
<!DOCTYPE HTML>

<html>
	<head>
		<title>Sign in</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="../assets/css/main.css" />
	</head>
	<body>
		<div class="page-wrap">

			<!-- Nav -->
			<?php include("../includes/menu1.html"); ?>

			<!-- Main -->
				<section id="main">

					<!-- Header -->
						<header id="header">
							<div><span>Camagru</span></div>
						</header>

					<!-- Section -->
						<section id="al">
							<div id="log">
								<header>
									<h1>Sign in</h1>
								</header>
								<form action="../controller/check.php" method="post">
									<span class="fa fa-user" aria-hidden="true"></span>
									<input type="text" id="usr" name="username" placeholder="Username.." maxlength="60" required>
									<span class="fa fa-key" aria-hidden="true"></span>
									<input type="password" name="passwd" placeholder="Password" maxlength="60" required></br>
									<input id="saveForm" name="signin-btn" type="submit" value="Sign in" />
									<?php
										if(isset($msg))
											echo $msg;
										if($_GET['t'] == "1")
											echo "ur password has been modified, log in!!";
										if($_GET['t'] == "2")
											echo "ur username has been modified, log in!!";
										if($_GET['t'] == "3")
											echo "ur email has been modified, check ur email before log in!!";
									?>
								</form>
								<br><a href='forgot.php' target="_blank" >Forgotten account?</a></br>
								<a  href='../view/sign-up.php'>sign up</a>
							</div>	
							<div id="continue-to-gallery"><a  href='../view/gallery.php'>Continue without sign up</a></div>
						</section>

					<!-- Contact -->
						<section id="contact">


							<!-- Form -->
								<div class="column">
									<h3>Get in Touch</h3>
									<form action="../controller/get-in-touch.php" method="post">
										<div class="field half first">
											<label for="name">Name</label>
											<input name="name" id="name" type="text" placeholder="Name">
										</div>
										<div class="field half">
											<label for="email">Email</label>
											<input name="email" id="email" type="email" placeholder="Email">
										</div>
										<div class="field">
											<label for="message">Message</label>
											<textarea name="message" id="message" rows="6" placeholder="Message"></textarea>
										</div>
										<ul class="actions">
											<li><input value="Send Message" class="button" type="submit"></li>
										</ul>
									</form>
								</div>

						</section>

					<!-- Footer -->
					<?php include("../includes/footer.html"); ?>
				</section>
		</div>


	</body>
</html>
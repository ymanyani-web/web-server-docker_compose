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
		<title>Sign up</title>
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
									<h1>Sign up</h1>
								</header>
								<form action="../controller/add.php" method="post">
									<!--username-->
										<span class="fa fa-user" aria-hidden="true"></span>
										<input type="text" name="username" placeholder="Username.."  maxlength="20" required>
									<!--email-->
										<span class="fa fa-envelope" aria-hidden="true"></span>
										<input type="email" name="email" placeholder="email.." maxlength="60" required>
									<!--password-->
										<span class="fa fa-key" aria-hidden="true"></span>
										<input type="password" name="passwd"  id="psw" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" maxlength="40" required>
									<!--password1-->
										<span class="fa fa-key" aria-hidden="true"></span>
										<input type="password" name="passwd1" placeholder="Retype Password" required maxlength="40"></br>
									<!--ok-->
										<input id="saveForm" name="signin-btn" type="submit" value="Sign up" />
								</form>
								<p><?php echo $msg;?></p>
								<br><a href="../view/sign-in.php">Already member!</a>
							</div>
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
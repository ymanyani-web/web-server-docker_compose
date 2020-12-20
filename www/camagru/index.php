<?php
session_start();

if(!empty($_SESSION['user']))
{
    header('Location: view/gallery.php');
}
?>

<!DOCTYPE HTML>

<html>
	<head>
		<title>Camagru</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="shortcut icon" href="">
	</head>
	<body>
		<div class="page-wrap">

			<!-- Nav -->
				<nav id="nav">
					<ul>
						<li><a href="#" class="active"><span class="icon fa-home"></span></a></li>
						<li><a href="view/profile.php"><span class="icon fa-camera-retro"></span></a></li>
					</ul>
				</nav>

			<!-- Main -->
				<section id="main">

					<!-- Banner -->
						<section id="banner">
							<div class="inner">
								<h1>Hey, I'm Camagru</h1>
								<ul class="actions">
									<li><a href="controller/camagru.php" class="button alt scrolly big">Continue</a></li>
								</ul>
							</div>
						</section>


					<!-- Contact -->
						<section id="contact">
							<!-- Social -->
								<div class="social column">

									<h3>Follow Me</h3>
									<ul class="icons">
										<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
										<li><a href="https://www.facebook.com/yazid.mn0" class="icon fa-facebook" target="_blank"><span class="label">Facebook</span></a></li>
										<li><a href="https://www.instagram.com/yazid.mn/" class="icon fa-instagram" target="_blank"><span class="label">Instagram</span></a></li>
									</ul>
								</div>

							<!-- Form -->
								<div class="column">
									<h3>Get in Touch</h3>
									<form action="controller/get-in-touch.php" method="post">
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
						<footer id="footer">
							<div class="copyright">
								&copy; By: <a href="https://profile.intra.42.fr/users/ymanyani" target="_blank">ymanyani</a>. 2020.
							</div>
						</footer>
				</section>
		</div>


	</body>
</html>
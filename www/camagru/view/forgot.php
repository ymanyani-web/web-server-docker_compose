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
									<h1>Enter ur email to reset ur password</h1>
								</header>
								<form action="../controller/f.php" method="post">
									<span class="fa fa-envelope" aria-hidden="true"></span>
									<input type="email"  name="email" placeholder="Email.." required><br>
									<input id="saveForm" name="signin-btn" type="submit" value="Reset" />
								</form>
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
<?php
session_start();

    $images_per_page = 10;
    $db = mysqli_connect('mysql', 'root', 'tiger', 'camagru');
    $sql = "SELECT * FROM images";
    $result = mysqli_query($db, $sql);
    $number_of_images = mysqli_num_rows($result);

    $number_of_pages = ceil($number_of_images/$images_per_page);

    if (isset($_GET['page'])){
        $page = intval($_GET['page']);
    if($page < 1){
            $page = 1;
        }
        
    }
    else{
            $page = 1;
        }
    $start_limit = ($page -1) * $images_per_page;

    $results = mysqli_query($db, "SELECT * FROM images ORDER BY id DESC LIMIT ".$start_limit.','.$images_per_page);
    $images = mysqli_fetch_all($results, MYSQLI_ASSOC);
    $r = mysqli_num_rows($results);

?>
<!DOCTYPE HTML>

<html>
	<head>
		<title>Gallery</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="../assets/css/main.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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
						<section id="all">
                            <div>
                                <?php foreach ($images as $image): ?>
                                <div class="abc">
                                    <div class="#">
                                        <a class="#" href="my_profile.php?user=<?php echo $image['username']; ?>" style="color: #000;"><?php echo $image['username']; ?></a>
                                    </div>
                                    <div class="lk" id="<?php echo $image['id'];?>">
                                        <a href="comments.php?imageid=<?php echo $image['id']; ?>"><img src="<?php echo '../img/' . $image['image'] ?>"  alt=""  class="post" ></a>
                                        <?php
                                        if(!empty($_SESSION['user']))
                                        {
                                        ?>
                                            <br/><p style="color:#2424FF;"><a class="llk" id="<?php echo $image['idd'];?>"><img src="../img/alpha/like.png"></a>[<?php echo $image['like_n']; ?>]</p>  
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                                <?php
                                if($r < 10)
                                {
                                    echo "you seen all posts";
                                }
                                ?>
                                <script>
                                    $(".lk").click(function(){
                                        var t= '#'+this.id;
                                        var usr="<?php echo $page ?> "+'#'+this.id;
                                        $.get("../controller/like.php?idd="+this.id, function(data, status){
                                            if (status == 'success')
                                                {
                                                    $(''+ t).load("gallery.php?page="+ usr);
                                                }
                                        });
                                    });     
                                </script>  
                            </div>
                            <?php
                                if ($page == 1)
                                {
                                    $page++;
                                    if($r == 10)
                                    echo '<a href="gallery.php?page=' . $page . '">' . '<img src="../img/alpha/next.png" class="next">' . '</a> '; 
                                }
                                elseif ($page >1)
                                {
                                    $page_moins = $page - 1;
                                    $page_plus = $page + 1;
                                    echo '<a href="gallery.php?page=' . $page_moins . '">' . '<img src="../img/alpha/prev.png" class="prev">' . '</a> '; 
                                    if($r == 10)
                                    echo '<a href="gallery.php?page=' . $page_plus . '">' . '<img src="../img/alpha/next.png" class="next">' . '</a> '; 
                                }
                            ?>
						</section>



					<!-- Footer -->
                    <?php include("../includes/footer.html"); ?>
				</section>
		</div>


	</body>
</html>
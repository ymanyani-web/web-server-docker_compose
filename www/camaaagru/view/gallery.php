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
        <script> 
            $("button").click(function(){
                $.get("demo_test.asp", function(data, status){
                    alert("Data: " + data + "\nStatus: " + status);
                });
            });
        </script>
        <body>
            <!-- menu -->
            <header id="header">
                <div class="container-fluid">  
                    <div id="logo" class="pull-left">
                        <h1><a href="../view/camagru.php" class="scrollto">Camagru</a></h1>
                    </div>

                    <nav id="nav-menu-container">
                        <ul class="nav-menu">
                            <?php if (!empty($_SESSION['user'])) : ?>
                            Welcome, <?php echo $_SESSION['user']; ?>
                            <?php else : ?>
                            Welcome Stranger
                            <?php endif ?>
                            <li  class="menu-active"><a href="../view/gallery.php">Gallery</a></li>
                            <li><a href="../view/profile.php">Profile</a></li>
                            <li class="menu-has-children"><a href="">Settings</a>
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
            </header><br><br><br><br>
            <!-- pictures -->
            <div>
                <?php foreach ($images as $image): ?>
                    <div class="abc">
                        <div class="#">
                            <a class="#" href="my_profile.php?user=<?php echo $image['username']; ?>" style="color: #47FF13;"><?php echo $image['username']; ?></a>
                        </div>
                        <div class="lk" id="<?php echo $image['id'];?>">
                            <a href="comments.php?imageid=<?php echo $image['id']; ?>"><img src="<?php echo '../img/' . $image['image'] ?>" height="300px" alt=""  class="post" ></a>
                            <?php if(!empty($_SESSION['user']))
                            {?>
                            <br/><p style="color:#47FF13;"><a class="llk" id="<?php echo $image['idd'];?>"><img src="../img/alpha/like.png"></a>[<?php echo $image['like_n']; ?>]</p>  
                            <?php }?>
                        </div>
                    </div>
                <?php endforeach; ?>
                <?php
                if($r < 10)
                {
                    echo "you seen all posts, try facebook or instagram, they have more users than us!";
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
                    echo '<a href="gallery.php?page=' . $page . '">' . '<img src="../img/alpha/next.png">' . '</a> '; 
                }
                elseif ($page >1)
                {
                    $page_moins = $page - 1;
                    $page_plus = $page + 1;
                    echo '<a href="gallery.php?page=' . $page_moins . '">' . '<img src="../img/alpha/prev.png">' . '</a> '; 
                    echo $page;
                    if($r == 10)
                    echo '<a href="gallery.php?page=' . $page_plus . '">' . '<img src="../img/alpha/next.png">' . '</a> '; 
                }
            ?>
        </body>
    </html>

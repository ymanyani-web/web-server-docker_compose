<?php
session_start();
$s = $_GET['user'];
if(isset($_SESSION['user']))
{
  /*   
    if(isset($_GET['user']) && ($_GET['user'] == $_SESSION['user'])){}
    else
        header('Location: gallery.php');*/
}
else
    header('Location: gallery.php'); 
?>
<?php
$db = mysqli_connect('mysql', 'root', 'tiger', 'camagru');
$results = mysqli_query($db, "SELECT * FROM images WHERE username='$s' ORDER BY id DESC");
$images = mysqli_fetch_all($results, MYSQLI_ASSOC);
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
        <style>
            .grid { 
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            grid-gap: 20px;
            align-items: stretch;
            }
            .grid img {
            border: 1px solid #ccc;
            box-shadow: 2px 2px 6px 0px  rgba(0,0,0,0.3);
            max-width: 100%;
            }
	</style>
    </head>
    <body>
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
                        <li><a href="../view/gallery.php">Gallery</a></li>
                        <li class="menu-active"><a href="../view/profile.php">Profile</a></li>
                        <li class="menu-has-children"><a>Settings</a>
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
    <?php if(isset($_GET['user']) && ($_GET['user'] == $_SESSION['user']))
            {?>
                <h1> Your images</h1>
            <?php
            }
        ?>
    <?php if(isset($_GET['user']) && ($_GET['user'] != $_SESSION['user']))
            {?>
                <h1> images</h1>
            <?php
            }
        ?>
        <main class="grid">
            <?php foreach ($images as $image): ?>
                <div class="holder">
                    <div class="#">
                        <div class="#">
                        </div>
                        <div class="img">
                            <a href="comments.php?imageid=<?php echo $image['id']; ?>"><img src="<?php echo '../img/' . $image['image'] ?>" width="250px" height="150px"  alt=""></a>
                            <?php
                            if(isset($_GET['user']) && ($_GET['user'] == $_SESSION['user']))
                            {
                                ?>
                                <br/><button class="del" id="<?php echo $image['id'] ?>" >Delete</button>  
                                <?php
                            }  
                            if(isset($_GET['user']) && ($_GET['user'] != $_SESSION['user']))
                            {
                                ?>
                                <div class="lk" id="<?php echo $image['id'] ?>">
                                <a><img src="../img/alpha/like.png"></a><p  style="color:#47FF13;">[<?php echo $image['like_n']; ?>]</p>
                                </div>
                                <?php
                            }  
                            ?>
                            
                        </div>
                    </div>
                </div> 
                <?php endforeach; ?>
        </main>
        <script>
        $(".lk").click(function(){
            var t= '#'+this.id;
            var usr="<?php echo $_GET['user'] ?> "+'#'+this.id;
            console.log(usr);
                $.get("../controller/like.php?idd="+this.id, function(data, status){
                    //alert("Data: " + data + "\nStatus: " + status);
                    if (status == 'success')
                        {
                          $(''+ t).load("my_profile.php?user="+ usr);
                        }
                });
            }); 
        $(".del").click(function(){
            var btn = this;
            $.get("../controller/delete.php?img="+this.id, function(data, status){
                //alert("Data: " + data + "\nStatus: " + status);
                if (status == 'success')
                    $(btn).closest('.holder').remove();
            });
        });
        </script>  
    </body>
</html>
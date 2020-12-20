<?php
session_start();
if (empty($_SESSION['user']))
{
    ?>
    <script>
        alert('ur not allowed');
        window.history.back();
    </script>
    <?php
}
if(isset($_GET['imageid']) && $_GET['imageid'] !== ''){

    include     '../controller/connect_db.php';
    $image_id = $_GET['imageid'];
    
    $reponse = $bdd->query("SELECT * FROM images WHERE id='$image_id'");
    $donnes = $reponse->fetch();
    $usr = $donnes['username'];
    $usr_c = $_SESSION['user'];

}

if(isset($_POST['comment_content']))
{
    include     '../controller/connect_db.php';
    $req = $bdd->prepare('INSERT INTO cmnt(prnt_comment, comment, comment_sender, img_id) VALUES(:prnt_cmnt, :cmnt, :comnt_s, :img)');
    $req->execute(array(
        'prnt_cmnt' => $usr,
        'cmnt' => $_POST['comment_content'],
        'comnt_s' => $usr_c,
        'img' => $image_id,
        ));

        $em = $bdd->query("SELECT * FROM users WHERE username='$usr'");
        $dd = $em->fetch();
        if($dd['cmnt-mail'] == '1')
        {
            $email = $dd['email'];
            require('../controller/db.php');
            send_mail_cmnt($usr, $email, $usr_c, $image_id);
            //header("Location: comments.php?imageid=$image_id");
        }                                
        
        
        
        
}
$db = mysqli_connect('mysql', 'root', 'tiger', 'camagru');
$results = mysqli_query($db, "SELECT * FROM cmnt WHERE img_id = '$image_id' ORDER BY `date` DESC");
$comments = mysqli_fetch_all($results, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8" />
            <title>View image</title>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" type="text/css" href="../css/my_style.css">
            <link rel="stylesheet" type="text/css" href="../css/admin.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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
           
             <div class="feed-image">

               <div class='abc'>
               <a class="#" href="my_profile.php?user=<?php echo $usr; ?>" style="color: #47FF13;"><?php echo $usr; ?></a>
               <img src="<?php echo '../img/' . $donnes['image'] ?>" width="450px"  alt="">
               <form method="POST" id="comment_form">
                    <input type="hidden" name="comment_sender" id="comment_sender" value="<?php echo $_SESSION['user'] ?>"/>
                    <textarea name="comment_content" id="comment_content"  placeholder="Enter Comment" rows="5" style="height:50px; width :450px;"></textarea>
                    <input type="hidden" name="image_id" id="image_id" value="<?php echo $image_id ?>" />
                    <input type="submit" name="submit" id="submit" class="btn btn-info" value="Submit" />
                </form>
               </div>
               
         </div>



         <div class="feed-footer">
                
            </div>


            <?php foreach ($comments as $comment): ?>
                    <div class="abc">
                        <div class="#">
                            <a class="#" href="my_profile.php?user=<?php echo $comment['comment_sender']; ?>" style="color: #47FF13;"><?php echo $comment['comment_sender']; ?></a>
                            <?php echo $comment['date']; ?>
                        </div>
                        <div class="lk" >
                           <p style="color:#ffffff;">  <?php echo $comment['comment']; ?></p>  
                        </div>
                    </div>
                    <?php endforeach; ?>
            
        </body>
<?php
session_start();
$s = $_SESSION['user'];
if(!isset($_SESSION['user']))
{
    echo "<script type='text/javascript'>alert('only members are allowed to access to this page, log in if u re or sign up if ur not!');</script>";
    //require('../index.php');
    //
    ?><script> window.history.back();</script><?php
}
?>
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

        <script type="text/javascript" src="webcamjs/webcam.min.js"></script>
<!-- ################################################CSS #####################################-->
        <style>
        #my_camera{

        width: 320px;
        height: 240px;
        border: 1px solid black;
        }
        </style>
        <div><h1>Take a picture with ur webcam</h1></div>
        <div class="cam">
            <div id="my_camera"></div>
            <input type=button value="Take Snapshot" onClick="take_snapshot()">
            <div id="results" ></div>
        </div>
        <form id='post' action='../controller/save_pic.php' method='post' enctype='multipart/form-data'>
            <div class="sidee">
                <ul>
                    <li><label><input type="radio" name="alpha" value="1" onclick="func('1')"><img style="width: 100px;" src="../img/alpha/1.png"></label></li>
                    <li><label><input type="radio" name="alpha" value="2" onclick="func('2')"><img style="width: 100px;" src="../img/alpha/2.png"></label></li>
                    <li><label><input type="radio" name="alpha" value="3" onclick="func('3')"><img style="width: 100px;" src="../img/alpha/3.png"></label></li>
                    </br>
                    <li><label><input type="radio" name="alpha" value="4" onclick="func('4')" checked>Nothing</label></li>
                </ul>
            </div>
            <div class="upl">
                <h1>Or upload a img</h1>
                <input class="btn btn-info" type="file" id='upload' onClick='clear_img()' name="webcam" accept="image/*">
            </div>
            <input type=button class="pub" name='publish' value="Publish" onClick="post()" id ="pub" disabled><br>
        </form>


    
        <!-- Webcam.min.js -->
        <script type="text/javascript" src="webcamjs/webcam.min.js"></script>

        <!-- Configure a few settings and attach camera -->
        <script language="JavaScript">
            Webcam.set({
            width: 320,
            height: 240,
            image_format: 'jpeg',
            jpeg_quality: 90
            });
            Webcam.attach( '#my_camera' );
            var img;
            /* Code to handle taking the snapshot and displaying it locally*/
            function take_snapshot() {
                // take snapshot and get image data
                Webcam.snap( function(data_uri) {
                    // display results in page
                    document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';

                    img = data_uri;

                    document.getElementById('upload').value = '';
                    document.getElementById('pub').disabled = false;
                } );
                console.log(s);
            }
            /* var s = document.getElementById('a4');
            if(s.checked)
            {
                console.log("1");
            }
            if(!s.checked)
            {
                console.log("2");
            } */
            var s = '4';

            function func(intValue)
            {
             s = intValue;
               console.log(s);
            }            

            function post()
            {
                if (document.getElementById("upload").files.length == 0)
                {
                    Webcam.upload( img, '../controller/save_pic.php?sup='+ s, function(code, text) {
                        console.log('good 2');
                        alert("ur img have been seccccc posted");
                        window.location.replace("gallery.php");
                    } );
                }
                else
                {
                    document.getElementById("post").submit();
                }
            }
            
            function clear_img()
            {
                document.getElementById('results').innerHTML = '';
                document.getElementById('pub').disabled = false;
            }

        </script>
<div class="my_i"><a href="my_profile.php?user=<?php echo $s?>">my Images</a></div>
    </body>
</html>
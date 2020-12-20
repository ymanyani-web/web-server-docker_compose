<?php
    session_start();

    if(!empty($_GET['sup']))
        $filter = $_GET['sup'];
    if(!empty($_POST['alpha']))
        $filter = $_POST['alpha'];

    include     'connect_db.php';
    $n = $_SESSION['user'];
    $reponse = $bdd->query('SELECT MAX(num) FROM images WHERE username =\'' . $n . '\'');
    while($donnees = $reponse->fetch())
    {    
        if(!empty($donnees['MAX(num)']))
            $s = $donnees['MAX(num)'] + 1;
        else
            $s = 1;

        if($_FILES['webcam']['type'] == "image/jpeg")
        {
            move_uploaded_file($_FILES['webcam']['tmp_name'], "../img/$n-$s.jpg");
            $path= "../img/$n-$s.jpg";
            #####################################################  MERGE  ############################################
            if($filter == '1' || $filter == '2' || $filter == '3')
            {
                $im = imagecreatefromjpeg($path);
                $alpha = imagecreatefrompng('../img/alpha/'.$filter.'.png');
                imagecopymerge_alpha($im, $alpha, 0, 0, 0, 0, imagesx($alpha), imagesy($alpha), 100);
                imagepng($im,  $path);
                imagedestroy($im); 
            }
            ###########################################################################################################
        }

        if($_FILES['webcam']['type'] == "image/png")
        {
            move_uploaded_file($_FILES['webcam']['tmp_name'], "../img/$n-$s.png");
            $path= "../img/$n-$s.png";
            ##################################################   MERGE   ############################################
            if($filter == '1' || $filter == '2' || $filter == '3')
            {
                $im = imagecreatefrompng($path);
                $alpha = imagecreatefrompng('../img/alpha/'.$filter.'.png');
                imagecopymerge_alpha($im, $alpha, 0, 0, 0, 0, imagesx($alpha), imagesy($alpha), 100);
                imagepng($im,  $path);
                imagedestroy($im); 
            }
            ###########################################################################################################
        }

        $req = $bdd->prepare('INSERT INTO images(username, `image`, num, like_n) VALUES(:username, :img, :num, :like_n)');
        $req->execute(array(
            'username' => $n,
            'img' => $path,
            'num' => $s,
            'like_n' => "0",
        ));
        echo '<script> window.location.replace("../view/gallery.php");</script>';
    }
return 'OK';
?>










<?php
function imagecopymerge_alpha($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct){
    // function patch for respecting alpha work find on http://php.net/manual/fr/function.imagecopymerge.php
    $cut = imagecreatetruecolor($src_w, $src_h);
    imagecopy($cut, $dst_im, 0, 0, $dst_x, $dst_y, $src_w, $src_h);
    imagecopy($cut, $src_im, 0, 0, $src_x, $src_y, $src_w, $src_h);
    imagecopymerge($dst_im, $cut, $dst_x, $dst_y, 0, 0, $src_w, $src_h, $pct);
}
?>
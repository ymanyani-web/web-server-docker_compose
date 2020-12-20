<?php
session_start();
include     'connect_db.php';

function imagecopymerge_alpha($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct){ 

	// function patch for respecting alpha work find on http://php.net/manual/fr/function.imagecopymerge.php
	$cut = imagecreatetruecolor($src_w, $src_h); 
	imagecopy($cut, $dst_im, 0, 0, $dst_x, $dst_y, $src_w, $src_h);
	imagecopy($cut, $src_im, 0, 0, $src_x, $src_y, $src_w, $src_h);
	imagecopymerge($dst_im, $cut, $dst_x, $dst_y, 0, 0, $src_w, $src_h, $pct); 
} 

if($_POST['tt'] == '0')
{
    $req = $bdd->prepare('UPDATE users SET `cmnt-mail` = :cmntemail WHERE username = :user');
        $req->execute(array(
            'cmntemail' => $_POST['tt'],
            'user' => $_SESSION['user']
            ));
}
if($_POST['tt'] == '1')
{
    $req = $bdd->prepare('UPDATE users SET `cmnt-mail` = :cmntemail WHERE username = :user');
        $req->execute(array(
            'cmntemail' => $_POST['tt'],
            'user' => $_SESSION['user']
            ));
}

?>
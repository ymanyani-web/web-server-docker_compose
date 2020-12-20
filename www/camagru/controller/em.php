<?php
session_start();
include     'connect_db.php';

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
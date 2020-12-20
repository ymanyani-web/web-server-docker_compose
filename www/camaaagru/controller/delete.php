<?php
session_start();
include     'connect_db.php';

$req = $bdd->prepare('DELETE FROM images WHERE id = :id_d_img');
$req->execute(array(
    'id_d_img' => $_GET['img']
    ));
    $s = $_SESSION['user'];
    //header("Location: ../view/my_profile.php?user=$s");
    return "OK";
?>
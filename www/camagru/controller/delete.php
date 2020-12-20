<?php
session_start();
include     'connect_db.php';

$img = $_GET['img'];

$reponse = $bdd->prepare('SELECT * FROM images WHERE id = :idd');
$reponse->execute(array(
'idd' => $img
));

$donnees = $reponse->fetch();

if($donnees['username'] == $_SESSION['user'])
{
    $req = $bdd->prepare('DELETE FROM images WHERE id = :id_d_img');
    $req->execute(array(
        'id_d_img' => $_GET['img']
    ));
    //header("Location: ../view/my_profile.php?user=$s");
    return "OK";
}
else
{
    ?>
    <script>
    alert('you have only the right to delete your pics');
    window.history.back();
    </script>
    <?php
}
?>
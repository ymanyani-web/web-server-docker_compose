<?php
session_start();
$s = $_SESSION['user'];
$id = $_GET['idd'];
include     'connect_db.php';
$conn = mysqli_connect("mysql","root","tiger","camagru");
    

    $sql_u = "SELECT * FROM `like_count` WHERE user='$s' AND id_liked_img='$id'";
    $res_u = mysqli_query($conn, $sql_u);
    $t = mysqli_num_rows($res_u);
    if($t == 1)
    {
        $sql = "DELETE FROM like_count WHERE user='$s' AND id_liked_img='$id'";
        $conn->query($sql);
        if (isset($_GET['idd'])) {
            $conn->query("UPDATE images SET like_n = like_n - 1 WHERE id=$id");
        }
    }  
    elseif($t == 0)
    {
        $req = $bdd->prepare('INSERT INTO like_count(`user`, `id_liked_img`) VALUES(:usr, :img)');
        $req->execute(array(
            'usr' => $s,
            'img' => $id,
        ));
        if (isset($_GET['idd'])) {
            $conn->query("UPDATE images SET like_n = like_n + 1 WHERE id=$id");
        }    
    }




     echo "test". "\n";
    echo $t. "\n";
    echo $s. "\n";
    echo $id. "\n"; 

/*     if (isset($_GET['usr'])) {
        $id = $_GET['idd'];
        $conn->query("UPDATE images SET like_n = like_n + 1 WHERE id=$id");
    } */
    ?>
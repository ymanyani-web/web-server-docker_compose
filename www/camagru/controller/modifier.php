<?php
session_start();
if (isset($_POST['pw1']) && is_null($_POST['pw1']))
{
    if( $_POST['pw1'] == $_POST['pw2'])
    {
        $email = $_GET['email'];
        $passwd = sha1($_POST['pw1']);
        include     'connect_db.php';
        $req = $bdd->prepare('UPDATE users SET `password` = :pw WHERE email = :email');
        $req->execute(array(
        'pw' => $passwd,
        'email' => $email
        ));
        header('Location: ../view/sign-in.php?t=1');
    }
    else 
        echo "passwords non identique";
}
if (isset($_POST['pw1']) && isset($_POST['pw0']))
{
    if( $_POST['pw1'] == $_POST['pw2'])
    {
        $passwd1 = sha1($_POST['pw1']);
        $passwd0 = sha1($_POST['pw0']);
        include     'connect_db.php';
        $reponse = $bdd->prepare('SELECT * FROM users WHERE username = :user');
        $reponse->execute(array(
        'user' => $_SESSION['user']
        ));
        $donnees = $reponse->fetch();
        if($donnees['password'] == $passwd0)
        {
        $req = $bdd->prepare('UPDATE users SET `password` = :pw WHERE username = :user');
        $req->execute(array(
            'pw' => $passwd1,
            'user' => $_SESSION['user']
            ));
            session_destroy();
            header('Location: ../view/sign-in.php?t=1');
        }
        else
        {
            $msg = " ur old password in invalid, try again!";
            require('../view/modify.php');
        }
    }
    else 
    {
        $msg = "passwords non identique";
        require('../view/modify.php');
    }
}
if(isset($_POST['user']) || isset($_POST['email']))
{
    include     'connect_db.php';
    $user = $_POST['user'];
    $email = $_POST['email'];
    $db = mysqli_connect('mysql', 'root', 'tiger', 'camagru');
    $sql_u = "SELECT * FROM users WHERE username='$user'";
  	$sql_e = "SELECT * FROM users WHERE email='$email'";
  	$res_u = mysqli_query($db, $sql_u);
    $res_e = mysqli_query($db, $sql_e);
    if(!empty($_POST['user']))
    {
        echo mysqli_num_rows($res_u);

        if(mysqli_num_rows($res_u) > 0)
        {
            $msg = " this username is already taken, try again!";
            require('../view/modify.php');
            die();
        }
        else
        {
            $req = $bdd->prepare('UPDATE users SET `username` = :username WHERE username = :user');
            $req->execute(array(
                'username' => $user,
                'user' => $_SESSION['user']
                ));
            $req = $bdd->prepare('UPDATE images SET `username` = :username WHERE username = :user');
            $req->execute(array(
                'username' => $user,
                'user' => $_SESSION['user']
                ));
            $req = $bdd->prepare('UPDATE like_count SET `user` = :username WHERE user = :user');
            $req->execute(array(
                'username' => $user,
                'user' => $_SESSION['user']
                ));    
            session_destroy();    
            echo '<script> window.location.replace("../view/sign-in.php?t=2");</script>';
        }
    }


        if(!empty($_POST['email']))
        {
            if(mysqli_num_rows($res_e) > 0)
            {
                $msg = "this email is already taken, try again!ß";
                require('../view/modify.php');  
                die();
            }
            else
            {
                $req = $bdd->prepare('UPDATE users SET `email` = :email, random = :a WHERE username = :user');
                $req->execute(array(
                    'email' => $email,
                    'a' => "0999",
                    'user' => $_SESSION['user']
                    ));
                    require('db.php');
                    send_mail1($_SESSION['user'], $email);
                    session_destroy(); 
                    echo '<script> window.location.replace("../view/sign-in.php?t=3");</script>';
            }
        }
    }
?>
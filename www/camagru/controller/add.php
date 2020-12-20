<?php
if($_POST['username'] && $_POST['email'] && $_POST['passwd'])
{   
    $user = trim(strtolower($_POST['username']));
    $email = trim($_POST['email']);
    $passwd = sha1($_POST['passwd']);
    $db = mysqli_connect('mysql', 'root', 'tiger', 'camagru');
    $sql_u = "SELECT * FROM users WHERE username='$user'";
  	$sql_e = "SELECT * FROM users WHERE email='$email'";
  	$res_u = mysqli_query($db, $sql_u);
  	$res_e = mysqli_query($db, $sql_e);
    if (mysqli_num_rows($res_u) > 0)
    {
        $msg = "Sorry... username already taken, try again !";
        //echo "<script type='text/javascript'>alert('$message');</script>";
        require('../view/sign-up.php');
    }
    else if(mysqli_num_rows($res_e) > 0)
    {
        $msg = "Sorry... email already taken, try again !";
        require('../view/sign-up.php');
    }
    elseif ($_POST['passwd'] != $_POST['passwd1'])
    {
        $msg = "passwors non identique";
        require('../view/sign-up.php');    
    }
    else
    { 	
        require('db.php');
        $random = rand(1000,9000);
        add_user($user, $email, $passwd, $random);
        send_mail($user, $email, $passwd, $random);
        $msg = 'check ur email for verification before log in';
        require('../view/sign-in.php');
    }
}
?>
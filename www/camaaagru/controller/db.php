<?php
function add_user($user, $email, $passwd, $random)
{
    include     'connect_db.php';
    $req = $bdd->prepare('INSERT INTO users(username, email, `password`, random) VALUES(:username, :email, :passwd, :random)');
    $req->execute(array(
        'username' => $user,
        'email' => $email,
        'passwd' => $passwd,
        'random' => $random,
        ));
}


function send_mail($user, $email, $passwd, $random)
{
    $to = $email;
    $subject = 'Signup | Verification';
    $message = "
    Thanks for signin up!
    Your account has been created, you can login with the following credentials after you have activated you account by pressing the url bellow. <br>
    --------------------------<br>
    Username: " . $user . "<br>
    --------------------------<br>
    Please click this link to activate ur account:<br>
    <a href='http://localhost:8080/camagru/controller/verify.php?user=" .$user. "&email=" .$email. "&random=" .$random. "' target='_blank'> verify </a>";
    $headers = "From:noreply@camagru \r\n";
    $headers .= "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    mail($to, $subject, $message, $headers);
}

function send_mail1($user, $email)
{
    $to = $email;
    $subject = 'email | Verification';
    $message = "
    u changed ur email !
    If it's you, you can log in with the following credentials after you have activated you account by pressing the url bellow. <br>
    --------------------------<br>
    Username: " . $user . "<br>
    --------------------------<br>
    Please click this link to activate ur account:<br>
    <a href='http://localhost:8080/camagru/controller/verify.php?user=" .$user. "&email=" .$email. "' target='_blank'> verify </a>";
    $headers = "From:noreply@camagru \r\n";
    $headers .= "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    mail($to, $subject, $message, $headers);
}

function send_mail_cmnt($user, $email, $sender, $img)
{
    $to = $email;
    $subject = "'$sender' comment ur post";
    $message = "
    hi '$user'
    u receiver a comnt from '$sender' !
    u can check it from the link<br>
    --------------------------<br>
    <a href='http://localhost:8080/camagru/view/comments.php?imageid=" .$img. "' target='_blank'> check my post </a><br>
    --------------------------<br>";
    $headers = "From:noreply@camagru \r\n";
    $headers .= "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    mail($to, $subject, $message, $headers);
}

function check_user($user, $passwd)
{
    include     'connect_db.php';
    $reponse = $bdd->query('SELECT * FROM users WHERE username =\'' . $user . '\'');
    $donnees = $reponse->fetch();
    if($donnees['username'] == $user && $donnees['password'] == $passwd && $donnees['active'] == "1")
        return ("good");
    else if($donnees['active'] == "0")
        return("not active");
}
?>
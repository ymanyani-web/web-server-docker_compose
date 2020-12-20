<?php
if($_POST['email'])
{   
    $email = $_POST['email'];
    $to = $email;
    $subject = 'reset password | Verification';
    $message = "
    forgotten password<br>
    Please click this link to reset ur password:<br>
    <a href='http://10.12.5.8/camagru/view/reset.php?email=" .$email. "' target='_blank'> reset </a>";
    $headers = "From:noreply@camagru \r\n";
    $headers .= "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    mail($to, $subject, $message, $headers);
    $msg = "check ur email to change ur password";
        require('../view/sign-in.php');
}
?>
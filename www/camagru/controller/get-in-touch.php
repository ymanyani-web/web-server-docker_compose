<?php
$sender = $_POST['name'];
$msg = $_POST['message'];
$em = $_POST['email'];
    $to = "yazid.mn2000@gmail.com";
    $subject = "Get in touch From $sender";
    $message = "
    ==================== HIS MESSAGE =================<br>
    " . $msg . "<br>
    ==================================================<br>
    his email if u like to respond him : $em
    ";
    $headers = "From:noreply@camagru \r\n";
    $headers .= "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    mail($to, $subject, $message, $headers);
    header('Location: ../index.php');
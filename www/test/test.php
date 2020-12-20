<?php
 
    ini_set( 'display_errors', 1 );
 
    error_reporting( E_ALL );
 
    $from = "test@votredomaine.com";
 
    $to = "yazid.mn2000@gamil.com";
 
    $subject = "Vérification PHP mail";
 
    $message = "PHP mail marche";
 
    $headers = "From:" . $from;
 
    if(mail($to,$subject,$message, $headers))
    {
        echo "L'email a été envoyé.";
    }
    else{
        echo "eee";
    }
?>
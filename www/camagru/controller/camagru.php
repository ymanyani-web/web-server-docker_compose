<?php
session_start();
if(isset($_SESSION['user']))
{
    header('Location: ../view/gallery.php');
}
else
{
    header('Location: ../view/sign-in.php');
}

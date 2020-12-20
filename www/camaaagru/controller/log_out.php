<?php
session_start();
session_destroy();
header('Location: ../view/log_in.php');
?>
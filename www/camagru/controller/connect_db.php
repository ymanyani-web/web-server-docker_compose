<?php
    try
    {
        $bdd = new PDO('mysql:host=mysql;dbname=camagru;charset=utf8', 'root', 'tiger');
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }

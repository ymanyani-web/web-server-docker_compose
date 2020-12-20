<?php
#!/usr/bin/php
include 'database.php';
// CREATE DATABASE
try {
    $conn = new PDO("mysql:host=$DB_DSN_LIGHT", $DB_USER, $DB_PASSWORD);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE DATABASE camagru";
    // use exec() because no results are returned
    $conn->exec($sql);
    echo "Database created successfully<br>";
    }
catch(PDOException $e)
    {
    echo "ERROR CREATING DATABASE: ".$e->getMessage()."Aborting process<br>";
        }

try {
        
        $dbh = new PDO("mysql:host=$DB_DSN_LIGHT;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE TABLE `users` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `username` varchar(100) NOT NULL,
            `email` varchar(100) NOT NULL,
            `password` varchar(255) NOT NULL,
            `random` int(11) NOT NULL,
            `active` tinyint(1) NOT NULL DEFAULT '0',
            `cmnt-mail` tinyint(1) NOT NULL DEFAULT '1',
            PRIMARY KEY (`id`)
        )";
        $dbh->exec($sql);
        echo "Table USERS created successfully<br>";
        }
catch (PDOException $e) {
    echo "ERROR CREATING USERS TABLE: ".$e->getMessage()."Aborting process<br>";
    }


try {
        
        $dbh = new PDO("mysql:host=$DB_DSN_LIGHT;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE TABLE `images` (
            `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `username` VARCHAR(100) NOT NULL,
            `image` VARCHAR(1000) NOT NULL,
            `num` int(11) NOT NULL,
            `like_n` int(11) DEFAULT '0'
        )";
        $dbh->exec($sql);
        echo "Table IMAGES created successfully<br>";
    } catch (PDOException $e) {
        echo "ERROR CREATING IMAGES TABLE: ".$e->getMessage()."Aborting process<br>";
    }
try {
        
        $dbh = new PDO("mysql:host=$DB_DSN_LIGHT;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE TABLE `like_count` (
            `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `user` VARCHAR(100) NOT NULL,
            `id_liked_img` int(11) NOT NULL
        )";
        $dbh->exec($sql);
        echo "Table like_count created successfully<br>";
    }
catch (PDOException $e) {
        echo "ERROR CREATING Like count Table: ".$e->getMessage()."Aborting process<br>";
    }
try {
        
        $dbh = new PDO("mysql:host=$DB_DSN_LIGHT;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE TABLE `cmnt` (
            `comment_id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `prnt_comment` varchar(200) NOT NULL,
            `comment` varchar(255) NOT NULL,
            `comment_sender` varchar(40) NOT NULL,
            `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `img_id` int(11) NOT NULL
          )";
        $dbh->exec($sql);
        echo "Table COMMENTS created successfully<br>";
    }
catch (PDOException $e) {
        echo "ERROR CREATING COMMENTS TABLE: ".$e->getMessage()."Aborting process<br>";
    }
?>
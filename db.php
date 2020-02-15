<?php

try {
    $db = new PDO("mysql:host=localhost;dbname=secim2019;charset=utf8mb4", "mamp", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $ex) {
    header("Location: error.php");
    exit;
    //die("<p>DB Connection Error : " . $ex->getMessage()) ;
}
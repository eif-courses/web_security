<?php
/**
 * Created by PhpStorm.
 * User: Marius
 * Date: 9/30/2017
 * Time: 6:18 PM
 */
ini_set('display_errors', 1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

$dbh = new PDO('mysql:host=localhost;dbname=securelogin', 'root','');

$stmt = $dbh->prepare("SELECT * FROM users;");
$stmt->execute();

$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($rows as $row){
    echo $row['user_username'];
}

?>
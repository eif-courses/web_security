<?php
include_once("header.php");
/**
 * Created by PhpStorm.
 * User: Marius
 * Date: 9/30/2017
 * Time: 11:55 PM
 */



echo 'Welcome <br/>' . $_COOKIE['user_username'] . '!';
echo ' <a href="logout.php">Logout</a>';
          func::getToken();
          func::createForm();

if (isset($_COOKIE['token'])){
    func::checkToken($_COOKIE['token']);
}


?><?php
include_once("footer.php");
?>

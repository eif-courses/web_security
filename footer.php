<footer>
<?php
echo '<a href="index.php">Index</a>  |';
if(func::checkLoginState($dbh)){
    echo '| <a href="admin.php">Admin</a> | <a href="logout.php">Logout</a>';
}
else{
    echo '<a href="login.php">Login</a>';
}


?>
</footer>
</body>
</html>
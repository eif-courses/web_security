<?php
include_once("header.php");

//$tokenas = bin2hex(random_bytes(16));
//$hash = hash('sha256', 'hello');
//$secret_key = hash_hmac('sha256', 'hello', 'secret');
//echo "<b>".$tokenas."</b><br/>";
//echo "Hash:<b>".$hash."</b><br/>";
//echo "Secret key:<b>".$secret_key."</b>";

?>
<section clas="parent">
    <div class="child">
        <?php
        if(!func::checkLoginState($dbh)){
            header("location:login.php");
            exit();
        }
        else{
            echo 'Welcome' . $_SESSION['username'] . '!';

        }
        ?>
    </div>
</section>


<?php
include_once("footer.php");
?>

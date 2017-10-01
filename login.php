<?php include_once("header.php"); ?>

    <section class="parent">
        <div class="child">
            <?php


            if (func::checkLoginState($dbh)) {
                header("location:index.php");
            }
            if (isset($_POST['username']) && isset($_POST['password'])) {

                $query = "SELECT * FROM users WHERE user_username = :username AND user_password = :password";

                $username = $_POST['username'];
                $password = $_POST['password'];

                $stmt = $dbh->prepare($query);
                $stmt->execute(array(':username' => $username, ':password' => $password));

                $row = $stmt->fetch(PDO:: FETCH_ASSOC);


                if ($row['user_id'] > 0) {
                    func::createRecord($dbh, $row['user_username'], $row['user_id']);
                    header("location:welcome.php");
                     //echo func::createString(32);
                }
            } else {
                echo '
                    <div class="login-page">
                      <div class="form">
                    
                        <form class="login-form" action="login.php" method="post">
                          <input type="text" name="username" placeholder="username"/>
                          <input type="password" name="password" placeholder="password"/>
                          <button>login</button>
                    
                        </form>
                      </div>
                   </div>
                    ';
            }
            ?>

        </div>
    </section>
<?php include_once("footer.php") ?>
<?php
/**
 * Created by PhpStorm.
 * User: Marius
 * Date: 9/30/2017
 * Time: 7:23 PM
 */

class func
{
    /**
     * @param $dbh
     */
    public static function checkLoginState($dbh){
        if(!isset($_SESSION['id']) || !isset($_COOKIE['PHPSESSID'])){
            session_start();
        }
        if(isset($_COOKIE['id']) && isset($_COOKIE['token']) && isset($_COOKIE['serial'])){

            $query = "SELECT * FROM sessions WHERE sessions_userid = :userid AND sessions_token = :token AND sessions_serial = :serial;";

            $userid = $_COOKIE['id'];
            $token = $_COOKIE['token'];
            $serial = $_COOKIE['serial'];

            $stmt = $dbh->prepare($query);
            $stmt->execute(array(':userid'=>$userid, ':token'=> $token, ':serial' => $serial));

            $row = $stmt->fetch(PDO:: FETCH_ASSOC);

            if($row['sessions_userid'] > 0){
                if($row['sessions_userid'] == $_COOKIE['userid'] &&
                $row['sessions_userid'] == $_COOKIE['token'] &&
                $row['sessions_userid'] == $_COOKIE['serial']
                ){
                    if($row['sessions_userid'] == $_SESSION['userid'] &&
                        $row['sessions_userid'] == $_SESSION['token'] &&
                        $row['sessions_userid'] == $_SESSION['serial']
                    ){
                        return true;
                    }

                }
            }

        }
    }

    public static function createRecord($dbh, $user_username, $user_id)
    {
        $query = "INSERT INTO sessions(sessions_userid, sessions_token, sessions_serial, sessions_date) VALUES(:user_id, :token, :serial, 5021)";

        $dbh->prepare('DELETE FROM sessions WHERE sessions_userid = :sessions_userid;')->execute(array(':sessions_userid' => $user_id));

        $token = func::createString(32);
        $serial = func::createString(32);

        func::createCookie($user_username, $user_id, $token, $serial);
        func::createSession($user_username, $user_id, $token, $serial);

        $stmt = $dbh->prepare($query);
        
        $stmt->execute(array(':user_id' => $user_id, ':token' => $token, ':serial' => $serial));

    }
    public static function createString($len){
        $tokenas = bin2hex(random_bytes($len));
        return $tokenas;
    }

    private static function createCookie($user_username, $user_id, $token, $serial)
    {
        setcookie('user_id', $user_id, time() + (86400) * 30, "/");
        setcookie('user_username', $user_username, time() + (86400) * 30, "/");
        setcookie('token', $token, time() + (86400) * 30, "/");
        setcookie('serial', $serial, time() + (86400) * 30, "/");
    }

    private static function createSession($user_username, $user_id, $token, $serial)
    {
        if(!isset($_SESSION['id']) || !isset($_SESSION['PHPSESSID'])) {
            session_start();
        }
        $_SESSION['user_username'] = $user_username;

        setcookie('user_id', $user_id, time() + (86400) * 30, "/");
        setcookie('token', $token, time() + (86400) * 30, "/");
        setcookie('serial', $serial, time() + (86400) * 30, "/");

    }
}
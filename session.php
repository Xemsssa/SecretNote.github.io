<?php
/**
 * Created by PhpStorm.
 * User: xemss
 * Date: 25.01.2017
 * Time: 13:52
 */

session_start();

//$_SESSION['username'] = "user";
//
//echo $_SESSION['username'];

if ($_SESSION['email']) {

    echo "User log in";

} else {

    header("Location: index.php");
    session_destroy();

}
<?php
/**
 * Created by PhpStorm.
 * User: xemss
 * Date: 25.01.2017
 * Time: 14:08
 */
    setcookie("customerId", "1234", time() + 3600);

    setcookie("customerId", "", time() - 3600);

    $_COOKIE["customerId"] = "test";

//    setcookie("customerId", "", time() - 3600);

    echo $_COOKIE["customerId"];
?>



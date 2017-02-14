<?php
/**
 * Created by PhpStorm.
 * User: xemss
 * Date: 26.01.2017
 * Time: 13:43
 */

$connect = mysqli_connect('localhost', "root", "root", "secretText");

if (!$connect) {
    die("Database connection error");
}

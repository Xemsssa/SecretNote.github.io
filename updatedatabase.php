<?php
/**
 * Created by PhpStorm.
 * User: xemss
 * Date: 26.01.2017
 * Time: 14:10
 */

if ( array_key_exists('content', $_POST) ) {

    echo $_POST['content'];
//    echo $_GET['content'];
    $sessionId = $_SESSION['id'];

    $query = "UPDATE users SET text = '" . $_POST['content'] . "' WHERE id = $sessionId ";

//    echo $query;
    $run_query = mysqli_query($connect, $query);

    if ($run_query) {

        echo "Updated";

    } else {

        echo "Error updating";

    }

} else {

    echo "error";

}

?>
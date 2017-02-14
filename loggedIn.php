<?php
/**
 * Created by PhpStorm.
 * User: xemss
 * Date: 25.01.2017
 * Time: 17:02
 */

session_start();


if ($_COOKIE['id']) {
    $_SESSION['id'] = $_COOKIE['id'];
}

if ($_SESSION['id']) {

    $sessionId = $_SESSION['id'];
    echo "<hr>";

    include ("connect.php");

    $query = "SELECT text FROM users WHERE id = $sessionId";

    $run_query = mysqli_query($connect, $query);
    if (!$run_query) {
        echo "Error";
    }

    $row = mysqli_fetch_array($run_query, MYSQLI_ASSOC);

    $text = $row['text'];

} else {
    header ("Location: MySQLproject.php");
}

include ("header.php");
?>
    <nav class="navbar navbar-toggleable-md navbar-light bg-faded">

        <a class="navbar-brand" href="index.php?logout=1">Navbar</a>

    </nav>

    <div class="container-fluid" id="text">

        <textarea id="textarea" name="text"><?php echo $text; ?></textarea>

    </div>

<?php
include ("footer.php");
?>
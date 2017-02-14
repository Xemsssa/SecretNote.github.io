<?php
/**
 * Created by PhpStorm.
 * User: xemss
 * Date: 25.01.2017
 * Time: 14:28
 *
 * didn't work ajax didn sent to database
 * add password repeat and verefication password
 * valid email with  email verefication code
 * reset password system
 * separate files, style
 * navbar
 * session problems
 *
 */

//if (session_start()) {
//    session_destroy();
//}

session_start();

if ($_GET['logout']) {
    unset($_SESSION);
    setcookie("id", "", time() - 3600);
    $_COOKIE['id'] = "";
//    $message = "unset";

} else if ( ($_SESSION['id'] && array_key_exists('id', $_SESSION) ) || ($_COOKIE['id'] && array_key_exists('id', $_COOKIE) ) ) {
    header ("Location: loggedIn.php");
}

//print_r($_POST);

if ($_POST) {
    include ("connect.php");

    $email = $_POST['email'];
    $password = $_POST['password'];

    $message = "";
    $successMessage = "";

    if ($email == "") {
        $message .= "The email field is required<br>";
    }

    if ($password == "") {
        $message .= "The password field is required<br>";
    }

    if ($message) {
        $message =  'There were error(s) in your form:<br>' . $message;
    } else {

        if ($_POST['signUp'] == '1' || $_GET['signUp'] == '1') {

            $query = "SELECT * FROM users WHERE email = '" . mysqli_real_escape_string($connect, $email) . "'";
            //        echo $query;

            $run_query = mysqli_query($connect, $query);

            if (mysqli_num_rows($run_query) > 0) {
                $message = "This $email address already used";
            } else {
                //            $query = "INSERT INTO users (email, password, text) VALUES ('$email', '$password', '$text')";
                $query = "INSERT INTO users (email, password) VALUES ('" . mysqli_real_escape_string($connect, $email) . "','" . mysqli_real_escape_string($connect, $password) . "')";

                //            echo $query;

                $run_query = mysqli_query($connect, $query);

                if ($run_query) {
                    //                echo "No errors";
                    $userId = mysqli_insert_id($connect);

                    $salt = md5(md5($userId) . $password);
                    //                $query = "UPDATE users WHERE id = '$userId'";
                    $query = "UPDATE users SET password = '$salt' WHERE email = '" . mysqli_real_escape_string($connect, $email) . "'";
//                    $query = "UPDATE users SET password = '$password' WHERE email = '" . mysqli_real_escape_string($connect, $email) . "'";

                    $run_query = mysqli_query($connect, $query);

                    // create page
                    if ($run_query) {

                        $_SESSION['id'] = $userId;
//                        $_SESSION['email'] = $email;

                        if ($_POST['stayLoggedIn'] == '1') {
                            //                    setcookie("");
                            setcookie("id",  $userId, time() + 3600);
//                            setcookie("email", $email, time() + 3600);
                        }
                        header("Location: loggedIn.php");

                    } else {
                        $message = "There is a problem wile insert password";
                    }

                } else {
                    $message = "There is the problem with inserting $email";
                }

            }
        } else {

            $query = "SELECT * FROM users WHERE email = '" . mysqli_real_escape_string($connect, $_POST['email']) . "'";

            $run_query = mysqli_query($connect, $query);

            $row = mysqli_fetch_array($run_query, MYSQLI_ASSOC);

            if (isset($row)) {

                $hashedPassword = md5(md5($row['id']) . $_POST['password']);
//                $pass = $row['password'];

                if ($hashedPassword == $row['password']) {

                    $_SESSION['id'] = $row['id'];

                    if ($_POST['stayLoggedIn'] == '1') {
                    setcookie("id", $row['id'], time() + 3600);
                    } else  {
                        $message = "Could not set cookies";
                    }
                    header("Location: loggedIn.php");
                } else {
                    $message ="Problem with pass";
                }

            } else  {
               $message = "User with this email Could not found";
            }
        }
//
//        if($message) {
//            $message =  '<div class="alert alert-danger" role="alert">' . $message . '</div>';
//        }
    }
}
?>

<?php include ("header.php"); ?>

<div class="container">
    <h1>Story For Your Eyes Only</h1>

    <h4>Store yours thoughts permanently and securely.</h4>

<!--    <div class="alert">--><?php //echo $message; ?>
    <div class="alert"><?php if ($message) {echo '<div class="alert alert-danger" role="alert">' . $message . '</div>';} ?>
    </div>


    <!--    Sign UP-->
    <form id ="signUp" method="post" action="index.php">
        <p>Interested? Get in.</p>
        <div class="form-group">
            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Your Email" value="<?php echo $email; ?>">

        </div>

        <div class="form-group">

            <input type="password" class="form-control" id="password" name="password" placeholder="Password">

        </div>

        <div class="form-check">

            <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="stayLoggedIn" value="1">
                Stay logged in
            </label>

        </div>

        <input type="hidden" name="signUp" value="1">

        <div class="form-group">
             <button type="submit" name="submit" class="btn btn-success">Sign UP!</button>
        </div>

        <div class="form-group">
            <p><a class="toggleForm" href="#">Log in</a></p>
<!--            <link rel="stylesheet" href="#">Log in-->
        </div>
    </form>

<!--Log in-->

    <form id="logIn" action="index.php" method="post">

    <p>Log in using your username and password.</p>

        <div class="form-group">

            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Your Email" value="<?php echo $_POST['email']; ?>">

        </div>

        <div class="form-group">

            <input type="password" class="form-control" id="password" name="password" placeholder="Password">

        </div>

        <div class="form-check">

            <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="stayLoggedIn" value="1">
                Stay logged in
            </label>

        </div>

        <input type="hidden" name="signUp" value="0">

        <div class="form-group">
            <button type="submit" name="submit" class="btn btn-success">Log in!</button>
<!--            <input type="submit" name="submit" value="Log in!">-->
        </div>

        <div class="form-group">
<!--            <link rel="stylesheet" href="#">Sign up-->
            <p><a class="toggleForm" href="#">Sign up</a></p>
        </div>
    </form>
</div>

<?php include ("footer.php"); ?>

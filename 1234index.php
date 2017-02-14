<?php
/**
 * Created by PhpStorm.
 * User: xemss
 * Date: 24.01.2017
 * Time: 16:29
 */
    session_start();
//
//    echo  $_SESSION['username'];

    $connect = mysqli_connect('localhost', 'root', 'root', 'cl29-users-bzh');

//    print_r($_POST);

    //echo mysqli_connect_error();

    if (mysqli_connect_error()) {
//        echo "Error";
        die("Three was an error connecting to database");
    } else {

        if ($_POST) {
//            print_r($_POST);

            if (array_key_exists("email", $_POST) OR array_key_exists("password", $_POST)) {

                $email = $_POST['email'];
                $password = $_POST['password'];

//                echo $pass;
                $message = "";

                if ($email == "") {
                    //                echo "empty";
                    $message .= "Please enter your email<br>";
                }

                if ($password == "") {
                    //                echo "error";
                    $message .= "Please enter your password<br>";
                }

                if ($message == "") {

                    // this commented version didn't work
                    // work forget connect
                    $query = "SELECT * FROM users WHERE email = '" . mysqli_real_escape_string($connect, $email) . "'";
//                    $query = "SELECT * FROM users WHERE email = '$email'";
//                    echo  $query;

                    $run_query = mysqli_query($connect, $query);

//                    if (mysqli_num_rows($run_query) > 0){
//                        echo "This email address already taken";
//                    }

                    if ($run_query) {

//                        print_r($run_query);

                        $row = mysqli_fetch_array($run_query, MYSQLI_ASSOC);
                        //
                        $emailDB = $row['email'];
//                        echo $emailDB;
//                         salt
//                        $salt = "eiviewiribin35y4t4o4om5h645mng45ym4";
//                        $pass = md5($salt . $password);
                        $pass = md5(md5($row['id']) . $password);
//                        echo $pass;

                        if ($email == $emailDB) {
                            //                        echo "User already exist";
                            $message = "<div class='alert alert-warning' role='alert'><strong>User already exist</strong>";
                        } else {
//                            echo "Welkome new user";
                            $query = "INSERT INTO users (email, password) VALUES ('" . mysqli_real_escape_string($connect, $email) . "','" . mysqli_real_escape_string($connect, $password) . "')";

                            if (mysqli_query($connect, $query)) {
                                //                            echo "New user inserted";
                                $_SESSION['email'] = $email;

                                header("Location: session.php");

//                                $message = "<div class='alert alert-success' role='alert'><strong>New user inserted</strong>";
                            }
                        }

                    } else {
                        $message = "<div class='alert alert-danger' role='alert'><strong>Could not connect to database. Try later :(</strong>";

                    }
                } else {
                    $message = "<div class='alert alert-danger' role='alert'><strong>There were error(s) in your form:<br> $message </strong>";
                }
            }
        }
//
    }

?>


<!DOCTYPE html>

<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
</head>
<body>

<div class="container">

    <h1>Enter your email and password </h1>

    <form action="index.php" method="post">
        <div id="alert"><?php echo $message; ?></div>
        <div class="form_group">
            <label for="email">Email</label>
            <input class="form-control" type="email" name="email" placeholder="Email" value="<?php echo $email; ?>">
        </div>

        <div class="form_group">
            <label for="password">Password</label>
            <input class="form-control" type="password" name="password">
        </div>

        <button type="submit" class="btn btn-primary" name="submit" >Log in</button>
<!--        <input type="submit" name="submit" ></input>-->
    </form>

</div>

<!-- jQuery first, then Tether, then Bootstrap JS. -->
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

</body>
</html>

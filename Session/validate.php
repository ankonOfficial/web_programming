<?php

session_start();

//if (!isset($_SESSION['uname'])) {
//    echo "<script>window.location.assign('index.php')</script>";
//} else {
//echo "<script>window.alert('i am here')</script>";
    $username = "";
    $password = "";
    if (isset($_POST['uname']) && isset($_POST['pass'])) {
        $username = $_POST['uname'];
        $password = $_POST['pass'];
    }

    if (!empty($username) && !empty($password)) {
        
        try {
            $con = new PDO('mysql:host=localhost;dbname=sessiondb', 'root', '');
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = "select * from users where uname='$username' && pass='$password'";
            $pdostmt = $con->query($stmt);

            if ($pdostmt->rowCount() == 1) {
                ///echo "<script>window.alert('i am here')</script>";
                $_SESSION['uname'] = $username;
                echo "<script>window.location.assign('home.php');</script>";
            } else {
                echo "<script>window.location.assign('index.php?status=invalid');</script>";
            }
        } catch (PDOException $ex) {
            echo "<script>window.location.assign('index.php?status=dberror');</script>";
        }
    } else {
        echo "<script>window.location.assign('index.php?status=invalid')</script>";
    }
//}
?>


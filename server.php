<?php
    session_start();
    
    $username = "";
    $email = "";
    $errors = array();
    $db = mysqli_connect(getenv('IP'), getenv('C9_USER'), '', 'c9');
    
    if(isset($_POST['register'])){
        $username = ($_POST['user']);
        $email = ($_POST['email']);
        $pass1 = ($_POST['pass1']);
        $pass2 = ($_POST['pass2']);
        if(empty($username)){
            array_push($errors, "Username is required");
        }
        if(empty($email)){
            array_push($errors, "Email is required");
        }
        if(empty($pass1)){
            array_push($errors, "Password is required");
        }
        if($pass1 != $pass2){
            array_push($errors, "Passwords does not match");
        }
        if(count($errors) == 0){
            $password = md5($pass1);
            $sql = "INSERT INTO user (username, email, password)
                VALUES ('$username', '$email', '$password')";
            mysqli_query($db, $sql);
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "Logged in";
            header('location: index.php');
        }
    }
    if(isset($_POST['login'])){
        $username = ($_POST['user']);
        $pass = ($_POST['pass']);
        if(empty($username)){
            array_push($errors, "Username is required");
        }
        if(empty($pass)){
            array_push($errors, "Password is required");
        }
        if(count($errors) == 0){
            $pass = md5($pass);
            $query = "SELECT * FROM user WHERE username='$username' AND password='$pass'";
            $result = mysqli_query($db, $query);
            if(mysqli_num_rows($result) == 1){
                $_SESSION['username'] = $username;
                $_SESSION['success'] = "Logged in";
                header('location: index.php');
            }
            else{
                array_push($errors, "incorrect usename/password");
            }
        }
    }
    if(isset($_GET['logout'])){
        session_destroy();
        unset($_SESSION['username']);
        header('location: login.php');
    }
?>
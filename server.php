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
            $query = "SELECT iduser FROM user";
            $result = mysqli_query($db, $query);
            $c = mysqli_num_rows($result);
            while(1){
                $query = "SELECT iduser FROM user where iduser='$c'";
                $result = mysqli_query($db, $query);
                if(mysqli_num_rows($result) != 0){
                    $c = $c + 1;
                }
                else{
                    break;
                }
            }
            $sql = "INSERT INTO user (username, email, password, iduser) VALUES ('$username', '$email', '$password', '$c')";
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
                array_push($errors, "incorrect username/password");
            }
        }
    }
    if(isset($_POST['user_delete'])){
        $username = ($_POST['user']);
        if(empty($username)){
            array_push($errors, "Username is required");
        }
        if(count($errors) == 0){
            $query = "SELECT * FROM user where username='$username'";
            $result = mysqli_query($db, $query);
            if(mysqli_num_rows($result) == 1){
                $query = "DELETE FROM user where username='$username'";
                $result = mysqli_query($db, $query);
                header('location: user.php');
            }
            else{
                array_push($errors, "incorrect username");
            }
        }
    }
    if(isset($_POST['theater_delete'])){
        $theater = ($_POST['theater']);
        if(empty($theater)){
            array_push($errors, "Theater name is required");
        }
        if(count($errors) == 0){
            $query = "SELECT * FROM theater where username='$theater'";
            $result = mysqli_query($db, $query);
            if(mysqli_num_rows($result) == 1){
                $query = "DELETE FROM theater where theater='$theater'";
                $result = mysqli_query($db, $query);
                header('location: theater.php');
            }
            else{
                array_push($errors, "incorrect theater name");
            }
        }
    }
    if(isset($_POST['theater_add'])){
        $theater_name = ($_POST['theater_name']);
        $total_seats = ($_POST['total_seats']);
        $floor = ($_POST['floor']);
        if(empty($theater_name)){
            array_push($errors, "Theater name is required");
        }
        if(empty($total_seats)){
            array_push($errors, "Number of total seats is required");
        }
        if(empty($floor)){
            array_push($errors, "Floor is required");
        }
        $query = "SELECT * FROM theater where name='$theater_name'";
        $result = mysqli_query($db, $query);
        if(mysqli_num_rows($result) != 0){
            array_push($errors, "Try another theater name");
        }
        if(count($errors) == 0){
            $query = "SELECT idtheater FROM theater";
            $result = mysqli_query($db, $query);
            $c = mysqli_num_rows($result);
            while(1){
                $query = "SELECT idtheater FROM theater where idtheater='$c'";
                $result = mysqli_query($db, $query);
                if(mysqli_num_rows($result) != 0){
                    $c = $c + 1;
                }
                else{
                    break;
                }
            }
            $sql = "INSERT INTO theater (idtheater, name, total_seats, floor) VALUES ('$c', '$theater_name', '$total_seats', '$floor')";
            mysqli_query($db, $sql);
        }
    }
    if(isset($_POST['movie_delete'])){
        $movie_title = ($_POST['movie']);
        if(empty($movie_title)){
            array_push($errors, "Movie title is required");
        }
        if(count($errors) == 0){
            $query = "SELECT * FROM movie where movie_title='$movie_title'";
            $result = mysqli_query($db, $query);
            if(mysqli_num_rows($result) == 1){
                $query = "DELETE FROM movie where movie_title='$movie_title'";
                $result = mysqli_query($db, $query);
                header('location: movie.php');
            }
            else{
                array_push($errors, "incorrect movie title");
            }
        }
    }
    if(isset($_POST['movie_add'])){
        $movie_title = ($_POST['movie_title']);
        $casting = ($_POST['casting']);
        $director = ($_POST['director']);
        $running_time =($_POST['running_time']);
        $type = ($_POST['type']);
        if(empty($movie_title)){
            array_push($errors, "Movie title is required");
        }
        if(empty($casting)){
            array_push($errors, "Casting is required");
        }
        if(empty($director)){
            array_push($errors, "Director is required");
        }
        if(empty($running_time)){
            array_push($errors, "Running time is required");
        }
        if(empty($type)){
            array_push($errors, "Type is required");
        }
        $query = "SELECT * FROM movie where movie_title='$movie_title' AND type='$type";
        $result = mysqli_query($db, $query);
        if(mysqli_num_rows($result) != 0){
            array_push($errors, "Try another movie");
        }
        if(count($errors) == 0){
            $query = "SELECT idmovie FROM movie";
            $result = mysqli_query($db, $query);
            $c = mysqli_num_rows($result);
            while(1){
                $query = "SELECT idmovie FROM movie where idmovie='$c'";
                $result = mysqli_query($db, $query);
                if(mysqli_num_rows($result) != 0){
                    $c = $c + 1;
                }
                else{
                    break;
                }
            }
            $sql = "INSERT INTO movie (idmovie, movie_title, director, casting, running_time, type) VALUES ('$c', '$movie_title', '$director', '$casting', '$running_time', '$type')";
            mysqli_query($db, $sql);
        }
    }    
    if(isset($_GET['logout'])){
        session_destroy();
        unset($_SESSION['username']);
        header('location: login.php');
    }
?>
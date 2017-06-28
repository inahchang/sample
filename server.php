<?php
    session_start();
    $username = "";
    $email = "";
    $errors = array();
    $print = array();
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
            $c = 1;
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
            mysqli_query($db, "START TRANSACTION");
            $sql = "INSERT INTO user (username, email, password, iduser) VALUES ('$username', '$email', '$password', '$c')";
            if ($dbconnect_error){
	            mysqli_query($db, "ROLLBACK");
            }
            else{
	            mysqli_query($db, "COMMIT");
            }
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
            $c = 1;
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
        $type = ($_POST['type']);
        if(empty($movie_title)){
            array_push($errors, "Movie title is required");
        }
        if(empty($type)){
            array_push($errors, "Type is required");
        }
        if(count($errors) == 0){
            $query = "SELECT * FROM movie where movie_title='$movie_title' AND type='$type'";
            $result = mysqli_query($db, $query);
            if(mysqli_num_rows($result) == 1){
                $query = "DELETE FROM movie where movie_title='$movie_title' AND type='$type'";
                $result = mysqli_query($db, $query);
                header('location: movie.php');
            }
            else{
                array_push($errors, "incorrect movie title/type");
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
        $query = "SELECT * FROM movie where movie_title='$movie_title' AND type='$type'";
        $result = mysqli_query($db, $query);
        if(mysqli_num_rows($result) != 0){
            array_push($errors, "Try another movie");
        }
        if(count($errors) == 0){
            $query = "SELECT idmovie FROM movie";
            $result = mysqli_query($db, $query);
            $c = 1;
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
    if(isset($_POST['movie_sch_delete'])){
        $movie = ($_POST['movie']);
        $type = ($_POST['type']);
        $theater = ($_POST['theater']);
        $show_time = ($_POST['show_time']);
        if(empty($movie)){
            array_push($errors, "Movie title is required");
        }
        if(empty($type)){
            array_push($errors, "Type is required");
        }
        if(empty($theater)){
            array_push($errors, "Theater is required");
        }
        if(empty($show_time)){
            array_push($errors, "Show time is required");
        }
        $query = "SELECT idmovie from movie where movie_title ='$movie' AND type='$type'";
        $result = mysqli_query($db, $query);
        if(mysqli_num_rows($result) == 1){
            foreach ($result as $r){
                $idmovie = $r['idmovie'];
            }
        }
        else{
            array_push($errors, "invalid movie");
        }
        $query = "SELECT idtheater from theater where name ='$theater'";
        $result = mysqli_query($db, $query);
        if(mysqli_num_rows($result) == 1){
            foreach ($result as $r){
                $idtheater = $r['idtheater'];
            }
        }
        else{
            array_push($errors, "invalid theater");
        }
        if(count($errors) == 0){
            $query = "SELECT * FROM movie_schedule where idmovie='$idmovie' AND idtheater='$idtheater' AND show_time='$show_time'";
            $result = mysqli_query($db, $query);
            if(mysqli_num_rows($result) == 1){
                $query = "DELETE FROM movie_schedule where idmovie='$idmovie' AND idtheater='$idtheater' AND show_time='$show_time'";
                $result = mysqli_query($db, $query);
                header('location: movie_schedule.php');
            }
            else{
                array_push($errors, "invalid movie schedule");
            }
        }
    }
    if(isset($_POST['movie_sch_add'])){
        $movie = ($_POST['movie_title']);
        $type = ($_POST['type']);
        $theater = ($_POST['theater']);
        $show_time =($_POST['show_time']);
        if(empty($movie)){
            array_push($errors, "Movie title is required");
        }
        if(empty($type)){
            array_push($errors, "Type is required");
        }
        if(empty($theater)){
            array_push($errors, "Theater is required");
        }
        if(empty($show_time)){
            array_push($errors, "Show time is required");
        }
        $query = "SELECT idmovie from movie where movie_title ='$movie' AND type='$type'";
        $result = mysqli_query($db, $query);
        if(mysqli_num_rows($result) == 1){
            foreach ($result as $r){
                $idmovie = $r['idmovie'];
            }
        }
        else{
            array_push($errors, "invalid movie");
        }
        $query = "SELECT idtheater from theater where name='$theater'";
        $result = mysqli_query($db, $query);
        if(mysqli_num_rows($result) == 1){
            foreach ($result as $r){
                $idtheater = $r['idtheater'];
            }
        }
        else{
            array_push($errors, "invalid theater");
        }
        $query = "SELECT * FROM movie_schedule where idmovie='$idmovie' AND idtheater='$idtheater' AND show_time='$show_time'";
        $result = mysqli_query($db, $query);
        if(mysqli_num_rows($result) != 0){
            array_push($errors, "Try another time");
        }
        if(count($errors) == 0){
            $query = "SELECT idmovie_schedule FROM movie_schedule";
            $result = mysqli_query($db, $query);
            $c = 1;
            while(1){
                $query = "SELECT idmovie_schedule FROM movie_schedule where idmovie_schedule='$c'";
                $result = mysqli_query($db, $query);
                if(mysqli_num_rows($result) != 0){
                    $c = $c + 1;
                }
                else{
                    break;
                }
            }
            $sql = "INSERT INTO movie_schedule (idmovie_schedule, idtheater, show_time, idmovie) VALUES ('$c', '$idtheater', '$show_time', '$idmovie')";
            mysqli_query($db, $sql);
        }
    }   
    if(isset($_POST['movie_list'])){
        $movie = ($_POST['movie']);
        $type = ($_POST['type']);
        if(empty($movie)){
            array_push($errors, "Movie title is required");
        }
        if(empty($type)){
            array_push($errors, "Type is required");
        }
        $query = "SELECT * FROM movie where movie_title='$movie' AND type='$type'";
        $result = mysqli_query($db, $query);
        if(mysqli_num_rows($result) == 0){
            array_push($errors, "Invalid movie");
        }
        if(count($errors) == 0){
            foreach ($result as $r){
                $idmovie = $r['idmovie'];
                $casting = $r['casting'];
                $director = $r['director'];
                $query = "SELECT * FROM movie INNER JOIN review on movie.idmovie = review.idmovie where movie.idmovie = '$idmovie'";
                $star = mysqli_query($db, $query);
                if(mysqli_num_rows($star) != 0){
                    $count = 0;
                    $avg_star = 0;
                    foreach($star as $s){
                        $avg_star = $avg_star + $s['stars'];
                        $count = $count + 1;
                    }
                    $avg_star = $avg_star / $count;
                }
                else{
                    $avg_star = "No review";
                }
                array_push($print ,"movie title: ".$movie."  ");
                array_push($print ,"movie type: ".$type."    ");
                array_push($print ,"director: ".$director."  ");
                array_push($print ,"casting: ".$casting."    ");
                array_push($print ,"average star: ".$avg_star."  ");
            }
        }
    } 
    if(isset($_POST['movie_review'])){
        $movie = ($_POST['movie']);
        $type = ($_POST['type']);
        if(empty($movie)){
            array_push($errors, "Movie title is required");
        }
        if(empty($type)){
            array_push($errors, "Type is required");
        }
        $query = "SELECT * FROM movie where movie_title='$movie' AND type='$type'";
        $result = mysqli_query($db, $query);
        if(mysqli_num_rows($result) == 0){
            array_push($errors, "Invalid movie");
        }
        if(count($errors) == 0){
            foreach ($result as $r){
                $idmovie = $r['idmovie'];
                $query = "SELECT * FROM movie INNER JOIN review on movie.idmovie = review.idmovie where movie.idmovie = '$idmovie'";
                $rev = mysqli_query($db, $query);
                if(mysqli_num_rows($rev) == 0){
                    array_push($print, "No review");
                }     
                else{
                    foreach ($rev as $rev1){
                        array_push($print, $rev1['review']);
                    }
                }
            }
        }
    }
    if(isset($_POST['write_review'])){
        $movie = ($_POST['movie']);
        $type = ($_POST['type']);
        $review = ($_POST['review']);
        $stars = ($_POST['stars']);
        if(empty($movie)){
            array_push($errors, "Movie title is required");
        }
        if(empty($type)){
            array_push($errors, "Type is required");
        }
        if(empty($review)){
            array_push($errors, "review is required");
        }
        if(empty($stars)){
            array_push($errors, "Star is required");
        }
        $query = "SELECT * FROM movie where movie_title='$movie' AND type='$type'";
        $result = mysqli_query($db, $query);
        if(mysqli_num_rows($result) == 0){
            array_push($errors, "Invalid movie");
        }
        else{
            foreach($result as $r){
                $idmovie = $r['idmovie'];
            }
        }
        $username = $_SESSIION['username'];
        $query = "SELECT * FROM user where username='$username'";
        $result = mysqli_query($db, $query);
        foreach($result as $r){
            $iduser = $r['iduser'];
        }
        $query = "SELECT * FROM review where idmovie='$idmovie' AND iduser='$iduser'";
        $result = mysqli_query($db, $query);
        if(mysqli_num_rows($result) != 0){
            array_push($errors, "You already wrote review on this movie");
        }        
        if(count($errors) == 0){
            $query = "SELECT idreview FROM review";
            $result = mysqli_query($db, $query);
            $c = 1;
            while(1){
                $query = "SELECT idreview FROM review where idreview='$c'";
                $result = mysqli_query($db, $query);
                if(mysqli_num_rows($result) != 0){
                    $c = $c + 1;
                }
                else{
                    break;
                }
            }
            $sql = "INSERT INTO review (idreview, idmovie, iduser, review, stars) VALUES ('$c', '$idreview', '$iduser', '$review', '$stars')";
            mysqli_query($db, $sql);
        }
    }
    if(isset($_POST['delete_review'])){
        $movie = ($_POST['movie']);
        $type = ($_POST['type']);
        if(empty($movie)){
            array_push($errors, "Movie title is required");
        }
        if(empty($type)){
            array_push($errors, "Type is required");
        }
        $query = "SELECT * FROM movie where movie_title='$movie' AND type='$type'";
        $result = mysqli_query($db, $query);
        if(mysqli_num_rows($result) == 0){
            array_push($errors, "Invalid movie");
        }
        else{
            foreach($result as $r){
                $idmovie = $r['idmovie'];
            }
        }
        $username = $_SESSIION['username'];
        $query = "SELECT * FROM user where username='$username'";
        $result = mysqli_query($db, $query);
        foreach($result as $r){
            $iduser = $r['iduser'];
        }
        $query = "SELECT * FROM review where idmovie='$idmovie' AND iduser='$iduser'";
        $result = mysqli_query($db, $query);
        if(mysqli_num_rows($result) == 0){
            array_push($errors, "invalid review");
        }        
        if(count($errors) == 0){
            $sql = "DELETE FROM review where iduser='$iduser' AND idmovie='$idmovie'";
            mysqli_query($db, $sql);
        }
    }
    if(isset($_POST['reservation'])){
        $idmovie_schedule = ($_POST['idmovie_schedule']);
        $how_many = ($_POST['how_many']);
        if(empty($idmovie_schedule)){
            array_push($errors, "Id movie schedule is required");
        }
        if(empty($how_many)){
            array_push($errors, "How many tickets do you want?");
        }
        $query = "SELECT * FROM movie_schedule where idmovie_schedule='$idmovie_schedule'";
        $result = mysqli_query($db, $query);
        if(mysqli_num_rows($result) == 0){
            array_push($errors, "Invalid movie schedule");
        }
        $username = $_SESSIION['username'];
        $query = "SELECT * FROM user where username='$username'";
        $result = mysqli_query($db, $query);
        foreach($result as $r){
            $iduser = $r['iduser'];
        }
        $query = "SELECT * FROM reservation where idmovie_schedule='$idmovie_schedule' AND iduser='$iduser'";
        $result = mysqli_query($db, $query);
        if(mysqli_num_rows($result) != 0){
            array_push($errors, "You already made a reservation on this movie");
        }        
        if(count($errors) == 0){
            $query = "SELECT idreservation FROM reservation";
            $result = mysqli_query($db, $query);
            $c = 1;
            while(1){
                $query = "SELECT idreservation FROM reservation where idreservation='$c'";
                $result = mysqli_query($db, $query);
                if(mysqli_num_rows($result) != 0){
                    $c = $c + 1;
                }
                else{
                    break;
                }
            }
            $sql = "INSERT INTO reservation (idreservation, idmovie_schedule, iduser, how_many) VALUES ('$c', '$idmovie_schedule', '$iduser', '$how_many')";
            mysqli_query($db, $sql);
        }
    }
    if(isset($_POST['cancel'])){
        $idreservation = ($_POST['idreservation']);
        if(empty($idreservation)){
            array_push($errors, "reservation number is required");
        }
        $query = "SELECT * FROM reservation where idreservation='idreservation'";
        $result = mysqli_query($db, $query);
        if(mysqli_num_rows($result) == 0){
            array_push($errors, "Invalid reservation number");
        }
        else{
            foreach($result as $r){
                $Iduser = $r['Iduser'];
            }
        }
        $username = $_SESSIION['username'];
        $query = "SELECT * FROM user where username='$username'";
        $result = mysqli_query($db, $query);
        foreach($result as $r){
            $iduser = $r['iduser'];
        }
        if($iduser != $Iduser){
            array_push($errors, "You are not the one who reserve this movie");
        }
        else{
            $query = "SELECT * FROM cancellation INNER JOIN reservation on cancellation.idreservation = reservation.idreservation";
            $result = mysqli_query($db, $query);
            if(mysqli_num_rows($result) != 0){
                array_push($errors, "Already cancelled");
            }
        }
        if(count($errors) == 0){
            $query = "SELECT idcancellation FROM cancellation";
            $result = mysqli_query($db, $query);
            $c = 1;
            while(1){
                $query = "SELECT idcancellation FROM cancellation where idcancellation='$c'";
                $result = mysqli_query($db, $query);
                if(mysqli_num_rows($result) != 0){
                    $c = $c + 1;
                }
                else{
                    break;
                }
            }
            $sql = "INSERT INTO cancellation (idcancellation, idreservation) VALUES ('$c', '$idreservation')";
            mysqli_query($db, $sql);
        }
    }
    if(isset($_GET['logout'])){
        session_destroy();
        unset($_SESSION['username']);
        header('location: login.php');
    }
?>
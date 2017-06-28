<?php
    include('server.php'); 
    if(empty($_SESSION['username'])){
        header('location: login.php');
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>reservation</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div id="frm">
        <?php
            $print = array();
            $iduser = $_SESSION['username'];
            $query = "SELECT * FROM reservation where iduser='$iduser'";
            $result = mysqli_query($db, $query);
            if(mysqli_num_rows($result) == 0){
                array_push($print, "no reservation");
            }
            else{
                foreach($result as $r){
                    $idreservation = $r['idreservation'];
                    $query = "SELECT * FROM cancellation where idreservation='$idreservation'";
                    $cancel = mysqli_query($db, $query);
                    $query = "SELECT * FROM movie_schedule INNER JOIN movie on movie_schedule.idmovie = movie.idmovie
                                INNER JOIN theater on theater.idtheater = movie_schedule.idtheater INNER JOIN reservation on reservation.idmovie_schedule = movie_schedule.idmovie_schedule
                                where idreservation='$idreservation'";
                    $info = mysqli_query($db, $query);                    
                    if(mysqli_num_rows($cancel) == 0){
                        foreach($info as $i){
                            array_push($print, $i['idreservation']." ".$i['movie_title']." ". $i['type']." ". $i['name']." ". $i['show_time']." ". $i['how_many']);
                        }
                    }
                    else{
                        array_push($print, "CANCELLED: ".$i['idreservation']." ".$i['movie_title']." ". $i['type']." ". $i['name']." ". $i['show_time']." ". $i['how_many']);
                    }
                }
            }
            include('print.php');
        ?>
        <p><a href="reserve.php">back to reserve/cancel</p>
    </body>
</html>
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
        <form action="reservation.php" method="POST">
            <?php include('errors.php'); ?>
            <div>
                List all movie schedule.
            </div>
            <div>
                <?php
                    $query = "SELECT * FROM movie_schedule INNER JOIN movie on movie_schedule.idmovie = movie.idmovie INNER JOIN theater on theater.idtheater = movie_schedule.idtheater";
                    $result = mysqli_query($db, $query);
                ?>
                <?php foreach ($result as $r): ?>
                <p><?php echo $r['idmovie_schedule']." ". $r['movie_title']. " ". $r['type']." ". $r['name']." ". $r['show_time']; ?></p>
                <?php endforeach ?>
            </div>
            <p>
                <label>id movie schedule:</label>
                <input type="text" id="user" name="idmovie_schedule" />
            </p>
            <p>
                <label>how many?:</label>
                <input type="text" id="user" name="how_many" />
            </p>
            <p>
                <input type="submit" id="btn" name="reservation" />
            </p>
            <p><a href="reserve.php">back to reserve/cancel</p>
        </form>
    </body>
</html>
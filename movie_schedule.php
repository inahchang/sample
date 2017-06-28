<?php
    include('server.php'); 
    if(($_SESSION['username']) != 'admin'){
        header('location: login.php');
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>manage movie schedule</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div id="frm">
        <form action="movie_schedule.php" method="POST">
            <?php include('errors.php'); ?>
            <div>
                List all movie schedule.
            </div>
            <div>
                <?php
                    $query = "SELECT * FROM movie_schedule INNER JOIN movie ON movie_schedule.idmovie = movie.idmovie INNER JOIN theater ON movie_schedule.idtheater = theater.idtheater";
                    $result = mysqli_query($db, $query);
                ?>
                <?php foreach ($result as $r): ?>
                <p><?php echo $r['movie_title'], $r['type'], $r['name'], $r['show_time']; ?></p>
                <?php endforeach ?>
            </div>
            <p>
                <label>delete(movie):</label>
                <input type="text" id="user" name="movie" />
            </p>
            <p>
            <label>delete(type):</label>
                <input type="text" id="user" name="type" />
            </p>
            <label>delete(theater):</label>
                <input type="text" id="user" name="theater" />
            </p>
            <label>delete(show time):</label>
                <input type="text" id="user" name="show_time" />
            </p>
            <p>
                <input type="submit" id="btn" name="movie_sch_delete" />
            </p>
        </form>
        
        <form method="post" action="movie_schedule.php">
            <?php include('errors.php'); ?>
            <div class="input-group">
                <label>movie title</label>
                <input type="text" name="movie_title">
            </div>
            <div class="input-group">
                <label>type</label>
                <input type="text" name="type">
            </div>
            <div class="input-group">
                <label>theater</label>
                <input type="text" name="theater">
            </div>
            <div class="input-group">
                <label>show time</label>
                <input type="text" name="show_time">
            </div>
            <div class="input-group">
                <button type="submit" name="movie_sch_add" class="btn">add</button>
            </div>
            <p>
                <a href="admin.php">back to administrator</a>
            </p>
        </form>
    </body>
</html>
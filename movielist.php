<?php
    include('server.php'); 
    if(empty($_SESSION['username'])){
        header('location: login.php');
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>movie list</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div id="frm">
        <form action="movielist.php" method="POST">
            <?php include('errors.php'); ?>
            <div>
                List all movie.
            </div>
            <div>
                <?php
                    $query = "SELECT * FROM movie";
                    $result = mysqli_query($db, $query);
                ?>
                <?php foreach ($result as $r): ?>
                <p style="color:blue;"><?php echo $r['movie_title'], $r['type'];?></p>
                <?php endforeach ?>
            </div>
            <p>
                <label>movie title:</label>
                <input type="text" id="user" name="movie" />
            </p>
            <p>
            <label>movie type:</label>
                <input type="text" id="user" name="type" />
            </p>
            <p>
                <input type="submit" id="btn" name="movie_list" />
            </p>
            <?php include('print.php') ?>
            <p><a href="index.php">back to mainpage</p>
        </form>
    </body>
</html>
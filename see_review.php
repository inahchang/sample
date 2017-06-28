<?php
    include('server.php'); 
    if(empty($_SESSION['username'])){
        header('location: login.php');
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>movie review</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div id="frm">
        <form action="see_review.php" method="POST">
            <?php include('errors.php'); ?>
            <p>
                <label>movie title:</label>
                <input type="text" id="user" name="movie" />
            </p>
            <p>
            <label>movie type:</label>
                <input type="text" id="user" name="type" />
            </p>
            <p>
                <input type="submit" id="btn" name="movie_review" />
            </p>
            <?php include('print.php'); ?>
            <p><a href="review.php">back to review</p>
        </form>
    </body>
</html>
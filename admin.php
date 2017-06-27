<?php
    include('server.php'); 
    if(($_SESSION['username']) != 'admin'){
        header('location: login.php');
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Administrator</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="header">
        <h2>Administrator</h2>
    </div>
    <div class="content">
        <p>
            1. <a href="user.php">user</a>
        </p>
        <p>
            2. <a href="theater.php">theater</a>
        </p>
        <p>
            3. <a href="movie.php">movie</a>
        </p>
        <p>
            4. <a href="movie_schedule.php">movie schedule</a>
        </p>
        <p>
            5. <a href="seat.php">seat</a>
        </p>
        <p>
            6. <a href="review.php">review</a>
        </p>
        <p>
            7. <a href="index.php">back to main</a>
    </div>
</body>
</html>
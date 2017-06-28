<?php
    include('server.php'); 
    if(empty($_SESSION['username'])){
        header('location: login.php');
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>write review</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div id="frm">
        <form action="write_review.php" method="POST">
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
                <p><?php echo $r['movie_title'], $r['type'] ?></p>
                <?php endforeach ?>
            </div>
            <p>
                <label>movie:</label>
                <input type="text" id="user" name="movie" />
            </p>
            <p>
            <label>type:</label>
                <input type="text" id="user" name="type" />
            </p>
            <label>review:</label>
                <input type="text" id="user" name="review" />
            </p>
            <label>stars:</label>
                <input type="text" id="user" name="stars" />
            </p>            
            <p>
                <input type="submit" id="btn" name="write_review" />
            </p>
            <p><a href="review.php">back to review</p>
        </form>
    </body>
</html>
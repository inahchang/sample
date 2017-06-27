<?php
    include('server.php'); 
    if(($_SESSION['username']) != 'admin'){
        header('location: login.php');
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>manage movie</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div id="frm">
        <form action="movie.php" method="POST">
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
                <p><?php echo $r['movie_title']; ?></p>
                <?php endforeach ?>
            </div>
            <p>
                <label>delete:</label>
                <input type="text" id="user" name="movie" />
            </p>
            <p>
                <input type="submit" id="btn" name="movie_delete" />
            </p>
        </form>
        
        <form method="post" action="movie.php">
            <?php include('errors.php'); ?>
            <div class="input-group">
                <label>movie title</label>
                <input type="text" name="movie_title">
            </div>
            <div class="input-group">
                <label>director</label>
                <input type="text" name="director">
            </div>
            <div class="input-group">
                <label>casting</label>
                <input type="text" name="casting">
            </div>
            <div class="input-group">
                <label>running time</label>
                <input type="text" name="running_time">
            </div>
            <div class="input-group">
                <label>type</label>
                <input type="text" name="type">
            </div>
            <div class="input-group">
                <button type="submit" name="movie_add" class="btn">add</button>
            </div>
            <p>
                <a href="admin.php">back to administrator</a>
            </p>
        </form>
    </body>
</html>
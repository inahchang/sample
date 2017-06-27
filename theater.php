<?php
    include('server.php'); 
    if(($_SESSION['username']) != 'admin'){
        header('location: login.php');
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>manage theater</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div id="frm">
        <form action="theater.php" method="POST">
            <?php include('errors.php'); ?>
            <div>
                List all theater.
            </div>
            <div>
                <?php
                    $query = "SELECT * FROM theater";
                    $result = mysqli_query($db, $query);
                ?>
                <?php foreach ($result as $r): ?>
                <p><?php echo $r['name']; ?></p>
                <?php endforeach ?>
            </div>
            <p>
                <label>delete:</label>
                <input type="text" id="user" name="theater" />
            </p>
            <p>
                <input type="submit" id="btn" name="theater_delete" />
            </p>
        </form>
        
        <form method="post" action="theater.php">
            <?php include('errors.php'); ?>
            <div class="input-group">
                <label>theater name</label>
                <input type="text" name="theater_name">
            </div>
            <div class="input-group">
                <label>total seats</label>
                <input type="text" name="total_seats">
            </div>
            <div class="input-group">
                <label>floor</label>
                <input type="text" name="floor">
            </div>
            <div class="input-group">
                <button type="submit" name="theater_add" class="btn">add</button>
            </div>
            <p>
                <a href="admin.php">back to administrator</a>
            </p>
        </form>
    </body>
</html>
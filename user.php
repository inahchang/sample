<?php
    include('server.php'); 
    if(($_SESSION['username']) != 'admin'){
        header('location: login.php');
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>manage user</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div id="frm">
        <form action="user.php" method="POST">
            <?php include('errors.php'); ?>
            <div>
                List all users' name.
            </div>
            <div>
                <?php
                    $query = "SELECT * FROM user";
                    $result = mysqli_query($db, $query);
                ?>
                <?php foreach ($result as $r): ?>
                <p><?php echo $r['username']; ?></p>
                <?php endforeach ?>
            </div>
            <p>
                <label>delete:</label>
                <input type="text" id="user" name="user" />
            </p>
            <p>
                <input type="submit" id="btn" name="user_delete" />
            </p>
            <p>
                <a href="admin.php">back to administrator</a>
            </p>
        </form>
</body>
</html>
<?php
    include('server.php'); 
    if(empty($_SESSION['username'])){
        header('location: login.php');
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>cancellation</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div id="frm">
        <form action="cancel.php" method="POST">
            <?php include('errors.php'); ?>
            <p>if you don't remember your reservation number check this page</p>
            <p><a href="check.php">check!</p>
            <p>
                <label>reservation number:</label>
                <input type="text" id="user" name="idreservation" />
            </p>
            <p>
                <input type="submit" id="btn" name="cancel" />
            </p>
            <p><a href="reserve.php">back to reserve/cancel</p>
        </form>
    </body>
</html>
<?php
    include('server.php'); 
    if(empty($_SESSION['username'])){
        header('location: login.php');
    }
?>

<DOCTYPE html>
<html>
<head>
    <title>reserve/cancel</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="header">
        <h2>Reserve/cancel</h2>
    </div>
    <div class="content">
        <p>1. <a href="reservation.php">reserve</p>
        <p>2. <a href="check.php">check reservation</p>
        <p>3. <a href="cancel.php">cancel</p>
        <p><a href="index.php">back to mainpage</p>
        <p><a href="index.php?logout='1'" style="color: red;">logout</p>
    </div>
</body>
</html>
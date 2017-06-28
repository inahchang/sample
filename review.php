<?php
    include('server.php'); 
    if(empty($_SESSION['username'])){
        header('location: login.php');
    }
?>

<DOCTYPE html>
<html>
<head>
    <title>review</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="header">
        <h2>Review</h2>
    </div>
    <div class="content">
        <p>1. <a href="see_review.php">review</p>
        <p>2. <a href="write_review.php">write review</p>
        <p>3. <a href="delete_review.php">delete review</p>
        <p><a href="index.php">back to mainpage</p>
        <p><a href="index.php?logout='1'" style="color: red;">logout</p>
    </div>
</body>
</html>
<?php include('server.php'); ?>
DOCTYPE html>
<html>
<head>
    <title>home page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="header">
        <h2>Home page</h2>
    </div>
    <div class="content">
        <?php if(isset($_SESSION['success'])): ?>
            <div calss="error success">
                <h3>
                    <?php
                        echo $_SESSIION['success'];
                        unset ($_SESSION['success']);
                    ?>
                </h3>
            </div>
        <?php endif ?>
        <?php if (isset($_SESSION["username"])): ?>
            <p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
            <p><a href="index.php?logout='1'" style="color: red;">logout</p>
        <?php endif ?>
    </div>
</body>
</html>
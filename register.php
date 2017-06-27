<?php include('server.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>register</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="header">
        <h2>Register</h2>
    </div>
    <form method="post" action="register.php">
        <?php include('errors.php'); ?>
        <div class="input-group">
            <label>Username</label>
            <input type="text" name="user">
        </div>
        <div class="input-group">
            <label>Email</label>
            <input type="text" name="email">
        </div>
        <div class="input-group">
            <label>Password</label>
            <input type="text" name="pass1">
        </div>
        <div class="input-group">
            <label>Confirm password</label>
            <input type="text" name="pass2">
        </div>
        <div class="input-group">
            <button type="submit" name="register" class="btn">register</button>
        </div>
        <p>
            Already a member? <a href="login.php">sign in</a>
        </p>
    </form>
</body>
</html>
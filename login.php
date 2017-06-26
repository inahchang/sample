<!DOCTYPE html>
<html>
<head>
    <title>login page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div id="frm">
        <form action="process.php" method="POST">
            <p>
                <label>Username:</label>
                <input type="text" id="user" name="user" />
            </p>
            <p>
                <label>Password:</label>
                <input type="password" id="pass" name="pass" />
            </p>            
            <p>
                <input type="submit" id="btn" name="Login" />
            </p>
            <p>
                Not yet a member <a href="register.php">sign up</a>
            </p>
        </form>
</body>
</html>
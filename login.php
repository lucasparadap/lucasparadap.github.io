<?php
session_start();

if( isset($_SESSION['user'])!="" ){
    header("Location: index.php");
}
include_once 'connect.php';

if ( isset($_POST['sca']) ) {
    $username = trim($_POST['username']);
    $pass = trim($_POST['pass']);
    $password = hash('sha256', $pass);

    $query = "select userid, username, pass from people where username=?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$username]);
    $count = $stmt->rowCount();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if( $count == 1 && $row['pass']==$password ) {
        $_SESSION['user'] = $row['userid'];
        header("Location: profile.php");
    }
    else {
        $message = "Invalid Login";
    }
    $_SESSION['message'] = $message;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <a class="return" href="#" style="text-align: center;"> home</a>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link href="Enough_Login.css" rel="stylesheet" type="text/css">

</head>
<body>
<h3 style="text-align:center;"></h3><br>
<p><h1>
    <?php
    if ( isset($message) ) {
        echo $message;
    }
    ?>
</h1></p>
<div class="loginbox">
    <img src="12072022 final enough logo design-12.PNG" class="avatar">
    <h1> Login Here</h1><br><br>
    <form action="login.php" method="post">
        <p> Username </p>
        <input type="text" name="" placeholder="Username">
        <p> Password </p>
        <input type="password" name="pass" placeholder="Enter Password"><br>
        <input type="submit" name="sca" value="Login" placeholder="Login"><br>
        <a href="#"> Forget your password?</a><br>
        <a href="#"> Create an account</a>
    </form>
</div>
</body>
</html>
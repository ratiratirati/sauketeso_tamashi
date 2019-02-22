<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/fonts.css">
</head>
<body>
<?php
include ('server.php');
include ('proces.php');
?>
<div class="register_form">
    <form method="post" action="register.php">
    <input type="text" name="username" placeholder="მომხმარებელი">
    <br>
    <input type="password" name="password" placeholder="პაროლი">
    <br>
    <input type="password" name="password_2" placeholder="გაიმეორეთ პაროლი">
    <br>
    <button name="register">რეგისტრაცია</button>
    <br>
    <a href="index.php">შესვლა</a>
    <div class="msg">
        <?php echo $msg;?>
    </div>
    <div class="error">
        <?php include ('error.php');?>
    </div>
    </form>
</div>
</body>
</html>
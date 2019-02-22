<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/home.css">
    <link rel="stylesheet" type="text/css" href="css/fonts.css">
    <script src="dropdown.js"></script>
</head>
<body>
<?php
include ('server.php');
include ('proces.php');

if(empty($_SESSION['username'])){
    header('location:index.php');
}

if(isset($_GET['logout'])){
    session_destroy();
    unset($_SESSION['username']);
    header('location:index.php');
}
?>
<div class="header">
    <div class="dropdown">
        <button onclick="myFunction()" class="dropbtn"><?php echo $_SESSION['username'];?></button>
        <div id="myDropdown" class="dropdown-content">
            <a href="home.php?logout='1'">გამოსვლა</a>
        </div>
    </div>
</div>
<div class="tamashi">
    <form method="post" action="home.php">
    <h1>გაინტერესებთ რას მოიგებთ მაშინ დააჭირეთ</h1>
    <br>
    <button name="statrt_game">თამაშის დაწყება</button>
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
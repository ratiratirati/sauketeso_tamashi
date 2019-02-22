<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/pass.css">
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
            <a href="home.php">უკან დაბრუნება</a>
            <a href="home.php?logout='1'">გამოსვლა</a>
        </div>
    </div>
</div>
<div class="pass_change">
    <form method="post" action="pass.php">
        <input type="text" name="dzveli_pas" placeholder="ძველი პაროლი">
        <br>
        <input type="text" name="axali_pas" placeholder="ახალი პაროლი">
        <br>
        <button name="change">შეცვლა</button>
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
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/paramets.css">
    <link rel="stylesheet" type="text/css" href="css/fonts.css">
    <link rel="stylesheet" href="css/boostrap.css">
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
            <a href="admin.php">უკან დაბრუნება</a>
            <a href="shedegebi.php">შედეგები</a>
            <a href="saitzea.php">საიტზე</a>
            <a href="parametrs.php">პარამეტრები</a>
            <a href="admin.php?logout='1'">გამოსვლა</a>
        </div>
    </div>
</div>
<div class="paramters">
    <form method="post" action="parametrs.php">
            <?php echo $msgss;?>
        <input id="num" type="checkbox" name="check" style='width:30px; height:30px;'>       <p>თამაში</p>
        <br>
        <button name="save_param">პარამეტრის შენახვა</button>
    </form>
</div>
</body>
</html>
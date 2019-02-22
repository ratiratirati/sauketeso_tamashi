<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/admin.css">
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
            <a href="shedegebi.php">შედეგები</a>
            <a href="saitzea.php">საიტზე</a>
            <a href="admin.php?logout='1'">გამოსვლა</a>
        </div>
    </div>
</div>
</body>
</html>
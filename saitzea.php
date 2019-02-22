<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/saitzea.css">
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
            <a href="admin.php?logout='1'">გამოსვლა</a>
        </div>
    </div>
</div>

<div class="saitze">
    <table>
        <tr>
            <th>username</th>
            <th>status</th>
        </tr>

        <?php

        $sql = "SELECT * FROM users";
        $res = mysqli_query($con,$sql);
        if(mysqli_num_rows($res)){
            while ($row = mysqli_fetch_assoc($res)){
                if($row['status'] == 1){
                    echo '<tr><td>'.$row['username'].' </td><td><img src="img/online.png" style="width: 80px;"> </td></tr>';
                }
            }

        }

        ?>

    </table>
</div>
</body>
</html>
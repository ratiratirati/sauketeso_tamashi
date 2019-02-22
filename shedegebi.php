<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/shedegebi.css">
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
<div class="statistick">
    <div class="w3-container">
        <table class="w3-table-all w3-hoverable">
            <thead>
            <tr class="w3-light-grey">
                <th>მომხმარებელი</th>
                <th>შედეგი</th>
            </tr>
            </thead>
            <?php

            $sql = "SELECT * FROM motamasheebi";
            $result = mysqli_query ($con,$sql);
            if(mysqli_num_rows ($result)){
                while ($row = mysqli_fetch_assoc ($result)){
                    echo '<tr><td>'.$row['saxeli'].'</td>'.'<td>'.$row['shedegebi'].'</td>';
                }
            }else{
                echo '<style>.statistick{display: none;}</style>';
            }

            ?>
        </table>
    </div>

</div>
</body>
</html>
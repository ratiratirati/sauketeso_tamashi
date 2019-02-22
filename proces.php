<?php

$msg = '';


function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

if(isset($_POST['register'])){
    $username = mysqli_real_escape_string ($con,$_POST['username']);
    $password = mysqli_real_escape_string ($con,$_POST['password']);
    $password_2 = $_POST['password_2'];
    $ip = get_client_ip();

    if(empty($username)){
        array_push ($errors,'მომხმარებლის ველი ცარიელია');
    }

    if(empty($password)){
        array_push ($errors,'პაროლის ველი ცარიელია');
    }

    if($password != $password_2){
        array_push($errors,'პაროლები არ ემთხვევა');
    }

//    if(!empty($password and strlen($password) != 8 )){
//        array_push($errors,'პაროლი უნდა შედგებოდეს 8 რიცხვისგან');
//    }

//    $sql = "SELECT * FROM users WHERE ip='$ip'";
//    $res = mysqli_query($con,$sql);
//    if(mysqli_num_rows($res) != 0 ){
//        array_push ($errors,'თქვენ ერთხელ გაიარეთ რეგისტრაცია');
//    }

    $sql = "SELECT * FROM users WHERE username='$username'";
    $res = mysqli_query($con,$sql);
    if(mysqli_num_rows($res)){
        array_push($errors,'<img src="img/user.png" style="width: 70px; padding-bottom: 10px;"><br>ესეთი მომხმარებელი უკვე არსებობს');
    }

    if(count ($errors) == 0 ){
        $password = md5 ($password);
        $sql = "INSERT INTO users (ip,username,password) VALUES ('$ip','$username','$password')";
        if(mysqli_query ($con,$sql)){
            $msg = '<img src="img/success.gif" style="width: 70px; padding-bottom: 10px;"><br>რეგისტრაცია წარმატებულია<iframe src="sound/success.mp3" allow="autoplay" style="display: none;"></iframe>';
        }
    }
}


if(isset($_POST['login'])){
    $username = mysqli_real_escape_string ($con,$_POST['username']);
    $password = mysqli_real_escape_string ($con,$_POST['password']);

    if(empty($username)){
        array_push ($errors,'მომხმარებლის ველი ცარიელია');
    }

    if(empty($password)){
        array_push ($errors,'პაროლის ველი ცარიელია');
    }

    if(count ($errors) == 0 ){
        $password = md5 ($password);
        $sql = "SELECT * FROM users WHERE username='$username' and password='$password'";
        $result = mysqli_query ($con,$sql);
        if(mysqli_num_rows ($result)){
            $row = mysqli_fetch_assoc ($result);
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $row['id'];
            if($username == 'admin'){
                header ('location:admin.php');
            }else{
                header ('location:home.php');
                $sql = "UPDATE users SET status=1 WHERE id='".$_SESSION['user_id']."'";
                mysqli_query ($con,$sql);
            }
        }else{
            array_push ($errors,'მომხმარებლის სახელი ან პაროლი არასწორია');
        }
    }
}

$ms='';
if(isset($_POST['statrt_game'])){
    $rand = rand(1,2);
    $username = $_SESSION['username'];
    $user_id = $_SESSION['user_id'];

    $sql = "SELECT * FROM motamasheebi WHERE user_id='$user_id'";
    $result = mysqli_query ($con,$sql);
    if(mysqli_num_rows ($result) >= 1 ){
        array_push ($errors,'თქვენ უკვე ითამაშეთ ერთხელ');
    }

    if(count ($errors) == 0 ){
    if($rand == 1){
        $ms = 'მოიგო შოკოლადი';
        $msg= '<img src="img/chockolate.png" style="width: 300px; padding-bottom: 30px;"><br>გილოცავთ თქვენ მოიგეთ შოკოლადი';
    }else{
        $ms = 'ვერ მოიგო შოკოლადი';
        $msg= '<img src="img/smile.png" style="width: 300px; padding-bottom: 30px;"><br>თქვენ სამწუხაროდ ვერ მოიგეთ შოკოლადი';
    }
    $sql = "INSERT INTO motamasheebi (saxeli,user_id,shedegebi) VALUES ('$username','$user_id','$ms')";
    mysqli_query ($con,$sql);
    }
}


if(isset($_GET['logout'])){
    $sql = "UPDATE users SET status=0 WHERE id='".$_SESSION['user_id']."'";
    mysqli_query ($con,$sql);
}

?>
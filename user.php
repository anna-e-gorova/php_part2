<?php
session_start();
include_once "config.php";
$errors = "";

$login =  !empty($_POST['login']) ? strip_tags($_POST['login']) : $errors .= "Поле Логин должно быть заполнено!<br>";
$pass =  !empty($_POST['pass']) ? md5(strip_tags($_POST['pass'])) : $errors .= "Поле Пароль должно быть заполнено!<br>";

if(isset($_POST['reg'])){
    if(!empty($errors)){
        header("Location: /?page=reg&errors_reg=$errors");
    }
    else{
        $sql = "insert into users(login,pass,usergroup) values('$login','$pass','user')";
        $res = mysqli_query($con,$sql);
        if($res){
            header("Location: /?page=reg&success_reg=true");
        }
    }
}
elseif(isset($_POST['auth'])){
    if(!empty($errors)){
        header("Location: /?page=auth&errors_reg=$errors");
    }
    else{
        $sql = "select id, usergroup from users where login='$login' and pass = '$pass'";
        $res = mysqli_query($con,$sql);
        $data = mysqli_fetch_assoc($res);
        if(mysqli_num_rows($res) > 0){
             $_SESSION['id_user'] = $data['id'];
             if($data['usergroup'] == 'admin'){
                 $_SESSION['admin'] = true;
             }
             header("Location: /?page=shop");
        }
        else{
            header("Location: /?page=auth&unexist=true");
        }
    }
}
<?php

if(isset($_GET['errors_reg'])){
    echo $_GET['errors_reg'];
} 
if(isset($_GET['unexist'])){
    echo "Пользователь не существует! Попробуйте снова";
} 
?>

<h1>Войдите в систему</h1>

<form action="user.php" method="post">
    <p>Введите логин</p>
    <input type="text" name="login">

    <p>Ваш пароль</p>
    <input type="password" name="pass"><br><br>

    <input type="submit" name="auth" value="Войти">
</form>
<br>
<a href='index.php?page=reg'>Регистрация</a>
<?php


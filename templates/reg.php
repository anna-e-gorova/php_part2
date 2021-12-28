<?php
if(isset($_GET['success_reg'])){
    echo "<h1>Вы успешно зарегистрированы</h1>";
}
if(isset($_GET['errors_reg'])){
    echo $_GET['errors_reg'];
}   
?>
   <form action="user.php" method="POST">
    <p>Введите логин</p>
    <input type="text" name="login">
    <p>Ваш пароль</p>
     <input type="password" name="pass">
    <br><br>
     <input type="submit" name="reg" value="Зарегистрироваться">
     
</form>
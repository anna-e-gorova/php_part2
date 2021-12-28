<form action="#" method="post">

    <p>Ваше имя</p>
    <input type="text" name="username">

    <input type="hidden" name="good" value="<?=$_GET['product']?>">

    <p>Оценка</p>
    <select name="rating">
        <?php 
        for ($i=10;$i>=1;$i--) :?>
            <option value="<?=$i?>"><?=$i?></option>
        <?php endfor;?>
    </select>

    <p>Напишите отзыв</p>
    <textarea name="comment" cols="30" rows="10"></textarea>
    <br><br>
    
    <input type="submit" value="Сохранить">

</form> 
<?php 
if ($_POST){
    addRating($con, $_POST);
}
?>
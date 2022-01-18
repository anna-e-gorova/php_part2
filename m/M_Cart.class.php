<?
class M_Cart {
    public static function getCart($id) {
        $sql="SELECT `cart`.`id`, `good_id`,`name`, `count` FROM `cart` inner join `users` on `cart`.`user_id`=`users`.`id` inner join `goods` on `cart`.`good_id`=`goods`.`id` WHERE `users`.`id`='$id';";
        $data = MPDO::Select($sql);
        return $data;
    }

}
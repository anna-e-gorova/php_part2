<?
class M_Order {
     public static function getOrders($id) {
        $sql = "SELECT order_id, date, status, SUM(price*count) as totalprice, SUM(count) as totalcount FROM `orders` INNER JOIN `goodsorder` ON `orders`.`id` = `goodsorder`.`order_id` INNER JOIN `users` ON `orders`.`user_id` = `users`.`id` INNER JOIN `goods` ON `goodsorder`.`good_id` = `goods`.`id` WHERE users.id = '$id' GROUP BY order_id;";
        $data = MPDO::Select($sql);
        return $data;
    }

    public static function getAllOrders() {
        $sql = "SELECT `order_id`, `login`, date, status, SUM(price*count) as totalprice, SUM(count) as totalcount FROM `orders` INNER JOIN `goodsorder` ON `orders`.`id` = `goodsorder`.`order_id` INNER JOIN `users` ON `orders`.`user_id` = `users`.`id` INNER JOIN `goods` ON `goodsorder`.`good_id` = `goods`.`id` GROUP BY order_id;";
        $data = MPDO::Select($sql);
        return $data;
    }
}
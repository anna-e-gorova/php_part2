<?
class M_Cart {
    public static function getCart($userId) {
        $data = [];
        if (!$userId && $_COOKIE["cart"]){
            foreach ($_COOKIE["cart"] as $goodId => $count) {
                $sql="SELECT `name`,`price` FROM `goods` WHERE `id`='$goodId';";
                $product = MPDO::getRow($sql);
                array_push($data, ['good_id' => $goodId, 'name' => $product['name'], 'count' => $count, 'price' => $product['price']*$count]);
            }
        } else {
            $sql="SELECT `cart`.`id`, `good_id`,`name`, `count`, `price`*`count` as `price` FROM `cart` inner join `users` on `cart`.`user_id`=`users`.`id` inner join `goods` on `cart`.`good_id`=`goods`.`id` WHERE `users`.`id`='$userId';";
            $data = MPDO::Select($sql); 
        }
        return $data;
    }

    public static function addFromCookie($userId){
        if ($_COOKIE["cart"]) {
            foreach ($_COOKIE["cart"] as $goodId => $count){
                M_Product::addToCart($goodId, $userId, $count);
                setcookie("cart[$goodId]", null, -1,'/');
            }
            unset($_COOKIE['cart']);
            if(setcookie("cart", null, -1,'/')){
                return true;
            } 
        }
    }

    public static function cleanCart($userId){
        if (!$userId && $_COOKIE["cart"]) {
            foreach ($_COOKIE["cart"] as $goodId => $count){
                setcookie("cart[$goodId]", null, -1,'/');
            }
            unset($_COOKIE['cart']);
            if(setcookie("cart", null, -1,'/')){
                return true;
            } 
        }  else {
            $sql = "DELETE FROM `cart` WHERE `cart`.`user_id` = '$userId'";
            $res = MPDO::delete($sql);
        }
    }

    public static function delFromCart($goodId, $userId){
        if (!$userId){
            $week = time() + (7 * 24 * 60 * 60);
            if($_COOKIE["cart"][$goodId] > 1){
                if(setcookie("cart[$goodId]",--$_COOKIE["cart"][$goodId],$week,'/')){
                    return 1;
                }
                return false;
            } else {
                unset($_COOKIE["cart"][$goodId]);
                if(setcookie("cart[$goodId]", null, -1,'/')){
                    return true;
                }
                return 1;
            }
        }
        $sql = "UPDATE `cart` SET `count` = `count` - 1 WHERE `good_id`='$goodId' AND `user_id`='$userId'";
		$res = MPDO::update($sql);	

		$sql = "DELETE FROM `cart` WHERE `cart`.`count` = 0";
		$res = MPDO::delete($sql);
    }

    public static function createOrder($userId){
        $carts = M_Cart::getCart($_POST['userId']);
		if($carts){
			$date = date("Y-m-d H:i:s");
			$sql = "INSERT INTO `orders` (`date`, `user_id`) VALUES ('$date', '{$_POST['userId']}');";
			$res = MPDO::insert($sql);
		 
			$sql = "SELECT id FROM `orders` WHERE `date`='$date';";
			$res = MPDO::getRow($sql);
			$idOrder = $res['id'];
		 
			foreach ($carts as $cart) {
			   $sql = "INSERT INTO `goodsorder` (`order_id`, `good_id`, `count`) VALUES ('$idOrder', '{$cart['good_id']}', {$cart['count']});";
			   $res = MPDO::insert($sql);
			}

            self::cleanCart($userId);
		 }
    }

}
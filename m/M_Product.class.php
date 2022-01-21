<?
class M_Product {
    public static function getGood($goodId) {
        $sql = "SELECT * FROM goods WHERE `id`='$goodId'";
        $data = MPDO::getRow($sql);
        return $data;    
    }

    public static function getGoodPhotos($goodId) {
        $dir = "images/goods/big/$goodId/";
        $files = scandir("$dir");
        return $files;    
    }

    public static function addToCart($goodId, $userId, $count = 1) {
        if (!$userId) {
            $week = time() + (7 * 24 * 60 * 60);
            if(!empty($_COOKIE["cart"][$goodId])){
                if(setcookie("cart[$goodId]",++$_COOKIE["cart"][$goodId],$week,'/')){
                    return 1;
                }
                return false;
            };
            if(setcookie("cart[$goodId]",1,$week,'/')){
                return 1;
            }
            
        } else {
            $sql="select * from cart inner join `users` on `cart`.`user_id`=`users`.`id` WHERE `good_id`='$goodId' AND `user_id`='$userId'";
		    $existGoods = MPDO::getRow($sql);

		    if (!$existGoods) {
			    $sql="INSERT INTO `cart` (`user_id`, `good_id`, `count`) VALUES ('$userId', '$goodId', '$count');";
			    $res = MPDO::insert($sql);
		    } else {
			    $sql = "UPDATE `cart` SET `count` = `count` + $count WHERE `good_id`='$goodId' AND `user_id`='$userId'";
			    $res = MPDO::update($sql);	
		    }
        }

    }
}
<?
class M_Rating {
    function addRating($rating) {
        $sql = "INSERT INTO `rating` (`rating`, `comment`, `good_id`, `username`) VALUES ('{$rating['rating']}', '{$rating['comment']}', '{$rating['good']}', '{$rating['username']}')";
        $res = MPDO::insert($sql);
    }

    public static function getRatings($goodId) {
        $sql="SELECT * FROM rating WHERE good_id='$goodId' AND active='Y'";
        $data = MPDO::Select($sql);
        return $data; 
    }

    public static function getAllRatings() {
        $sql="SELECT rating.id, goods.name as good_name, username, rating, `comment`, rating.active FROM rating INNER JOIN goods on rating.good_id=goods.id ORDER BY goods.name";
        $data = MPDO::Select($sql);
        return $data; 
    }
}
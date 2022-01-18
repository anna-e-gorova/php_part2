<?
class M_Rating {
    function addRating($rating) {
        $sql = "INSERT INTO `rating` (`rating`, `comment`, `good_id`, `username`) VALUES ('{$rating['rating']}', '{$rating['comment']}', '{$rating['good']}', '{$rating['username']}')";
        $res = MPDO::insert($sql);
    }

    public static function getRatings() {
        $sql="SELECT * FROM rating WHERE good_id='{$_GET['id']}'";
        $data = MPDO::Select($sql);
        return $data; 
    }
}
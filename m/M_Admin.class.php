<?
class M_Admin {
    
    public static function addGood($name,$info,$price,$img) {
        $sql = "insert into goods(name,description,price,img) value('$name','$info',$price,'$img')";
        $goodId = MPDO::insert($sql);
        return $goodId;    
    }

    public static function editGood($name,$info,$price,$img,$goodId) {
        $sql = "update goods set name='$name',description='$info',price=$price,img='$img' where id='$goodId'";
        $res = MPDO::update($sql);
        return $res;    
    }

    public static function delGood($goodId) {
        $sql = "SELECT img FROM goods WHERE `id`='$goodId'";
        $file = MPDO::getRow($sql);
        is_file(DIR_BIG_IMG . $file['img']) ? unlink(DIR_BIG_IMG . $file['img']) : "";
        is_file(DIR_SMALL_IMG . $file['img']) ? unlink(DIR_SMALL_IMG . $file['img']) : "";

        $sql = "DELETE FROM `goods` WHERE `goods`.`id` = $goodId";
        $res = MPDO::delete($sql);
        return $res;    
    }

}
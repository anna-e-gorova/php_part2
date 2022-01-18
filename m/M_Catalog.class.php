<?
class M_Catalog {
    public static function getGoods($offset=0) {
        $sql = "SELECT * FROM goods WHERE id > $offset and id <= $offset + 25";
        $data = MPDO::Select($sql);
        return $data;    
    }

}
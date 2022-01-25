<?
class M_Catalog {
    public static function getGoods($offsetFrom = 0, $limit = 6) {
        $sql = "SELECT * FROM goods WHERE active='Y' AND id > $offsetFrom LIMIT $limit";
        $data = MPDO::Select($sql);
        return $data;    
    }

    public static function getAllStatusGoods($offsetFrom = 0, $offsetTo = 6) {
        $sql = "SELECT * FROM goods WHERE id > $offsetFrom and id <= $offsetFrom + $offsetTo";
        $data = MPDO::Select($sql);
        return $data;    
    }

}
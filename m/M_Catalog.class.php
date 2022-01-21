<?
class M_Catalog {
    public static function getGoods($offsetFrom = 0, $offsetTo = 5) {
        $sql = "SELECT * FROM goods WHERE id > $offsetFrom and id <= $offsetFrom + $offsetTo";
        $data = MPDO::Select($sql);
        return $data;    
    }

}
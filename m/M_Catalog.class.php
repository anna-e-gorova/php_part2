<?
class M_Catalog {
    public static function getGoods($offsetFrom = 0, $offsetTo = 6) {
        $sql = "SELECT * FROM goods WHERE id > $offsetFrom and id <= $offsetFrom + $offsetTo AND active='Y'";
        $data = MPDO::Select($sql);
        return $data;    
    }

}
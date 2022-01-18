<?
class M_Product {
    function getGood() {
        $sql = "SELECT * FROM goods WHERE `id`='{$_GET['id']}'";
        $data = MPDO::getRow($sql);
        return $data;    
    }
}
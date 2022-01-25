<?php
require_once 'index.php';

use PHPUnit\Framework\TestCase;

class CatalogTest extends TestCase{

    public function testGetAllGoods(){
        $this->assertNotNull(M_Catalog::getGoods(0,100));
    }

    public function testGetLimitProduct(){
        $res = M_Catalog::getGoods();
        $this->assertNotNull($res);
        $this->assertEquals(25,count($res));
    }

    public function testGetOneProduct(){
        $res = M_Product::getGood(rand(1,100));
        $this->assertNotNull($res);
    }
    
}

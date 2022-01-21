<?php
require_once 'index.php';

use PHPUnit\Framework\TestCase;

class OrderTest extends TestCase{
   
    public function testGetAllOrders(){
        $this->assertNotNull(M_Order::getAllOrders());
    }

    public function testGetOneOrder(){
        $this->assertNotNull(M_Order::getOrders(rand(1,3)));
    }
}

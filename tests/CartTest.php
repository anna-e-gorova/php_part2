<?php
require_once 'index.php';

use PHPUnit\Framework\TestCase;

class CartTest extends TestCase{
    
    public function testGetCart(){
        $this->assertNotNull(M_Cart::getCart(8));
    }
    
}

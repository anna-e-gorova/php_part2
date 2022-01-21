<?php
require_once 'index.php';

use PHPUnit\Framework\TestCase;

class RatingTest extends TestCase{
    
    public function testGetRatings(){
        $res = M_Rating::getRatings(rand(1,3));
        $this->assertNotNull($res);
    }
}

<?php
require_once 'index.php';

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase{
    
    public function testGetUsername(){
        $username = M_User::getUsername(1);
        $this->assertSame($username, "admin");
    }
    
}

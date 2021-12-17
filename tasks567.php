<?php
//задание 5
class A {
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}
$a1 = new A();
$a2 = new A();
$a1->foo();
$a2->foo();
$a1->foo();
$a2->foo();
echo "<hr>";
//получаем результат 1234 потому, что переменная х являеться статической и она привязана не к обьекту а к классу.

//задание 6

class B {
    public function doo() {
        static $y = 0;
        echo ++$y;
    }
}
class C extends B {
}
$a1 = new B();
$b1 = new C();
$a1->doo(); 
$b1->doo(); 
$a1->doo(); 
$b1->doo();
echo "<hr>";

//получаем результат 1122 потому, что классы разные хоть и наследуют друг друга.

//задание 7

class D {
    public function moo() {
        static $x = 0;
        echo ++$x;
    }
}
class E extends D {
}
$a1 = new E;
$b1 = new D;
$a1->moo(); 
$b1->moo(); 
$a1->moo(); 
$b1->moo(); 

//У конструктора нет параметров, поэтому скобки не обязательны. Поэтоу эта запись идентична примеру из 6-го задания.
<?php
//Задание 1

abstract class Good {
    private $name;
    private $price;
    
    function __construct($name, $price){
        $this->name=$name;
        $this->price=$price;
    }

    function setName($name){
        $this->name=$name;
    }

    function setPrice($price){
        $this->price=$price;
    }

    function getName(){
        return $this->name;
    }

    function getPrice(){
        return $this->price;
    }

    abstract function finalPrice();

    function profit() {
        $costPrice = $this->getPrice() / 10;
        return $this->finalPrice() - $costPrice;
    }
}

class Digital extends Good{

    function finalPrice() {
        return $this->getPrice() / 2;
    }
}

class Piese extends Good {

    function finalPrice() {
        return $this->getPrice();
    }
}

class Weight extends Good {
    private $weight;

    function __construct($name, $price, $weight){
        parent::__construct($name, $price);
        $this->weight=$weight;
    }

    function setWeight($weight){
        $this->weight=$weight;
    }

    function getWeight(){
        return $this->weight;
    }

    function finalPrice() {
        return $this->getPrice() * $this->getWeight();
    }

    function profit() {
        $costPrice = $this->getPrice() / 10;
        return $this->finalPrice() - $costPrice * $this->getWeight();
    }
}

$good1 = new Digital("Рецепт", "10");
echo "Финальная цена цифрового товара составляет: {$good1->finalPrice()} <br> Прибыль от продаж: {$good1->profit()} <br>";

$good2 = new Piese("Колбаса", "10");
echo "Финальная цена штучного товара составляет: {$good2->finalPrice()} <br> Прибыль от продаж: {$good2->profit()} <br>";

$good3 = new Weight("Пельмени", "10", "5");
echo "Финальная цена весового товара составляет: {$good3->finalPrice()} <br> Прибыль от продаж: {$good3->profit()} <br>";

//Задание 2

trait someTrait {
    public static function getInstance() {
        if (self::$_instance === null) {
            self::$_instance = new self;
        }
        return self::$_instance
    }
}

class someClass {
    protected static $_instance;

    private function __construct() {
    }
    use someTrait;
}
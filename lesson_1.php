<?php
class Product{
    private $title;
    private $price;
    private $images;

    function __construct($title, $price, $images)
    {
        $this->title = $title;
        $this->price = $price;
        $this->images = $images;
    }

    function render() {
        echo $this->title;
        echo $this->price;
        echo $this->images;
    }
}

class OpenProduct extends Product {
    private $description;

    public function __construct($title, $price, $images, $description)
    {
        parent::__construct(($title, $price, $images);
        $this->description = $description;
    }
    function render() {
        parent::render();
        echo $this->description;
    }    
    function addToCart() {

    }
}

class CartProduct extends Product {
    function dellToCart() {

    }
    function order() {
        
    }
}
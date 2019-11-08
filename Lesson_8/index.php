<?php
//Опишите 5 классов и создайте по 2 объекта каждого класса — Машина, Телевизор, Шариковая ручка, Утка, Товар.
// Классы должны содержать свойства и методы. Все в одном файле.
class Cars
{
    private $name;
    private $color;
    private $weight;
    private $price;
    private $type;

    public function __construct($name, $color, $weight, $price, $type)
    {
        $this->name = $name;
        $this->color = $color;
        $this->weight = $weight;
        $this->price = $price;
    }

    public function getPrice()
    {
        $price = $this->price;
        if ($this->type === 'cargo') {
            $price = $this->price * 0.9;
        }
        return $price;
    }

    public function getType()
    {
        if ($this->weight > 2500) {
            $this->type = 'cargo';
        } else {
            $this->type = 'passenger';
        }
        return $this->type;
    }
}

$mitsubishi = new Cars ('pajero', 'white', 2200, 2400000, 'SUV');
$toyota = new Cars ('corolla', 'black', 1600, 1800000, 'pass');
$gaz = new Cars ('gazelle', 'red', 2700, 800000, 'cargo');
echo $mitsubishi->getPrice() . '<br />';
echo $toyota->getPrice() . '<br />';
echo $gaz->getPrice() . '<br />';
echo $mitsubishi->getType() . '<br />';
echo $toyota->getType() . '<br />';
echo $gaz->getType() . '<br />';

class BallPen
{
    public $color;
    private $type;

    public function __construct($color, $type)
    {
        $this->color = $color;
        $this->type = $type;
    }

    public function changeType($newType)
    {
        $this->type = $newType;
    }
}

class Product
{
    private $name;
    private $price;
    private $weight;
    private $color;

    public function __construct($name, $price, $weight, $color)
    {
        $this->name = $name;
        $this->price = $price;
        $this->weight = $weight;
        $this->color = $color;
    }

    public function getColor()
    {
        return $this->color;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getWeight()
    {
        return $this->weight;
    }

}

class Duck extends Product
{
    public function getWeight()
    {
        return parent::getWeight();
    }
}

class Television extends Product
{
    private $model;
    public $discount;
    public $discountPrice;

    public function __construct($name, $price, $weight, $color, $model, $discount)
    {
        parent::__construct($name, $price, $weight, $color, $model, $discount);
    }

    public function getDiscoutPrice()
    {
        $this->discountPrice = parent::getPrice() * $this->discount;
        return $this->discountPrice;
    }
}

$product = new Product('Продукт', 500, 200, 'бесцветный');
$product = new Product('Продукт2', 600, 300, 'цветной');

$ek = new BallPen('red', 'gel');
$bik = new BallPen('blue', 'ball');

$sony = new Television('SONY', 8500, 10600, 'RED', L500, 0.9);
$philips = new Television('PHILIPS', 5500, 8300, 'BLACK', S2000, 0.85);

$duck1 = new Duck('name1', 500, 550, 'white');
$duck1 = new Duck('name2', 700, 750, 'black');

echo $sony->getDiscoutPrice() . '<br />';// 7650
echo $sony->discount . '<br />';

echo $duck1->getWeight();

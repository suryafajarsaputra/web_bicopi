<?php

namespace App\Models;

class Product
{
    public $name;
    public $price;
    public $image;

    public function __construct($name, $price, $image)
    {
        $this->name = $name;
        $this->price = $price;
        $this->image = $image;
    }

    public static function all()
    {
        return collect([
            new Product('Headphone A', 150000, 'headphone-a.jpg'),
            new Product('Headphone B', 200000, 'headphone-b.jpg'),
            new Product('Headphone C', 250000, 'headphone-c.jpg')
        ]);
    }
}


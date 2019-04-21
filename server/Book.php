<?php
namespace ProductManagement;

class Book implements Product
{
    private $weight;

    public function __construct($sku, $name, $price, $weight)
    {
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
        $this->weight = $weight;
    }
}
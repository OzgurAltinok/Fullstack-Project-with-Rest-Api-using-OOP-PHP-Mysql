<?php
namespace ProductManagement;

class Product
{
    private $sku;
    private $name;
    private $price;

    public function __construct($sku, $name, $price)
    {
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
    }

    public function print()
    {
      echo $this->sku . $this->name . $this->price;
    }
}

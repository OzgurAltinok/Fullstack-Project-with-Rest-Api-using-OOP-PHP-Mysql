<?php

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

    public function getSku()
    {
      return $this->sku;
    }

    public function getName()
    {
      return $this->name;
    }

    public function getPrice()
    {
      return $this->price;
    }

    public function printAsJson()
    {
      $obj = new stdClass();
      $obj->sku = $this->sku;
      $obj->name = $this->name;
      $obj->price = $this->price;
      
      return $obj;
    }
}

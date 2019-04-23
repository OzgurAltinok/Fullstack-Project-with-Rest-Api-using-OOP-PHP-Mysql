<?php

class Book extends Product
{
    private $sku;
    private $name;
    private $price;
    private $weight;

    public function __construct($sku, $name, $price, $weight)
    {
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
        $this->weight = $weight;
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

    public function getWeight()
    {
      return $this->weight;
    }

    public function printAsJson()
    {
      $obj = new stdClass();
      $obj->sku = $this->sku;
      $obj->name = $this->name;
      $obj->price = $this->price;
      $obj->weight = $this->weight;
      
      return $obj;
    }
}
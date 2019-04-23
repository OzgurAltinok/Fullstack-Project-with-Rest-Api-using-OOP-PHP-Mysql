<?php

class Furniture extends Product
{
    private $sku;
    private $name;
    private $price;
    private $dimensions;

    public function __construct($sku, $name, $price, $dimensions)
    {
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
        $this->dimensions = $dimensions;
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

    public function getDimensions()
    {
      return $this->dimensions;
    }

    public function printAsJson()
    {
      $obj = new stdClass();
      $obj->sku = $this->sku;
      $obj->name = $this->name;
      $obj->price = $this->price;
      $obj->dimensions = $this->dimensions;
      
      return $obj;
    }
}
<?php

class Dvddisc extends Product
{
    private $sku;
    private $name;
    private $price;
    private $size;

    public function __construct($sku, $name, $price, $size)
    {
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
        $this->size = $size;
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

    public function getSize()
    {
      return $this->size;
    }

    public function printAsJson()
    {
      $obj = new stdClass();
      $obj->sku = $this->sku;
      $obj->name = $this->name;
      $obj->price = $this->price;
      $obj->size = $this->size;
      
      return $obj;
    }
}
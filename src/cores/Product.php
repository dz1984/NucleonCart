<?php
namespace NucleonCart\Core;

use NucleonCart\Core\ProductInterface; 

class Product implements ProductInterface
{
  protected $id;
  protected $price;
  
  public function __construct($id, $price)
  {
    $this->id = $id;
    $this->price = $price;
  }

  public function getId()
  {
    return $this->id;
  }

  public function getPrice()
  {
    return $this->price;
  }
}
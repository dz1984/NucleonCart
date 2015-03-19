<?php
namespace NucleonCart\Core;

use NucleonCart\Core\ProductInterface; 

class Product implements ProductInterface
{
  protected $id;
  protected $price;
  
  public function __construct($id = -1, $price = 0)
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
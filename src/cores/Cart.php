<?php
namespace NucleonCart\Core;

use NucleonCart\Core\ProductInterface; 

class Cart implements CartInterface
{
  
  protected $storage;

  public function __construct(Storage $storage = null)
  {
    $this->storage = $storage;
  }

  public function add(ProductInterface $product = null)
  {
    if (is_null($product)) {
      return false;
    }

    return true;
  }

  public function remove(ProductInterface $product = null)
  {
    if (is_null($product)) {
      return false;
    }

    return true;
  }

  public function checkout()
  {
    return null;
  } 
}
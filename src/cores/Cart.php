<?php
namespace NucleonCart\Core;

use NucleonCart\Core\ProductInterface; 
use NucleonCart\Core\Order; 

class Cart implements CartInterface
{
  
  protected $storage;

  public function __construct(Storage $storage = null)
  {
    $this->storage = array();
  }

  public function add(ProductInterface $product = null, $quantity = 1)
  {
    if (is_null($product)) {
      return false;
    }

    $id = $product->getId();

    $this->storage[$id] = array(
      'item' => $product,
      'quantity' => $quantity
    );

    return true;
  }

  public function remove(ProductInterface $product = null)
  {
    if (is_null($product)) {
      return false;
    }

    $id = $product->getId();

    $is_exist = array_key_exists($id, $this->storage);

    if (false === $is_exist) {
      return false;
    }

    unset($this->storage[$id]);

    return true;
  }

  public function checkout()
  {
    return new Bill($this->total());
  } 

  public function count()
  {
    $count = 0;

    foreach($this->storage as $item) {
      $count += $item['quantity'];
    }
    return $count;
  }

  public function total()
  {
    $total = 0.0;

    foreach($this->storage as $item) {
      $product = $item['item'];
      $total += $product->getPrice() * $item['quantity'];
    }

    return $total;
  }
}
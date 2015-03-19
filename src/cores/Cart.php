<?php
namespace NucleonCart\Core;

use NucleonCart\Core\ProductInterface; 

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
    return null;
  } 

  public function count()
  {
    $count = 0;
    foreach($this->storage as $item) {
      $count += $item['quantity'];
    }
    return $count;
  }
}
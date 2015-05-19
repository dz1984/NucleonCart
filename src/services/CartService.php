<?php
namespace NucleonCart\Service;

use NucleonCart\Core\CartInterface;
use NucleonCart\Core\ProductInterface;

class CartService 
{
  protected $cart;

  public function __construct(CartInterface $cart = null)
  {
    $this->cart = $cart;
  }

  public function add(ProductInterface $product = null)
  {
    // TODO : insert the business Logic 
    return $this->cart->add($product);
  }

  public function remove(ProductInterface $product = null)
  {
    // TODO : insert the business Logic
    return $this->cart->remove($product);
  }

  public function checkout()
  {
    // TODO : insert the business Logic
    return $this->cart->checkout();
  }

  public function count($id = null)
  {
    return $this->cart->count($id);
  }

}
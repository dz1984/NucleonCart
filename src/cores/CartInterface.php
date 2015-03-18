<?php
namespace NucleonCart\Core;

use NucleonCart\Core\ProductInterface;

interface CartInterface 
{
  // add the product into the cart
  public function add(ProductInterface $product);

  // remove the product from the cart
  public function remove(ProductInterface $product);

  // generate a new order if checkout is success, otherwise return null
  public function checkout();  
}
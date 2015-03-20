<?php
namespace NucleonCart\Service;

use NucleonCart\Core\BillInterface;
use NucleonCart\Core\ShippingInterface;

class ShippingService 
{
  public function apply(BillInterface $bill = null, ShippingInterface $shipping = null)
  {
    if (is_null($bill) || is_null($shipping)) {
      return false;
    }

    return true;
  }
}
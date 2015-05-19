<?php
namespace NucleonCart\Core;

class Shipping implements ShippingInterface
{
  protected $name;

  public function __construct($name = null)
  {
      $this->name = $name;
  }

  public function getName()
  {
    return $this->name;
  } 

  public function apply(BillInterface $bill = null)
  {
    if (is_null($bill)) {
      return false;
    }

    return $bill;
  }
}

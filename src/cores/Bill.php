<?php
namespace NucleonCart\Core;

use NucleonCart\Core\BillInterface;

class Bill implements BillInterface
{
  protected $coupon = array();

  public function setCoupon(CouponInterface $coupon = null)
  {
    if (is_null($coupon)) {
      return false;
    }

    $this->coupon[] = $coupon;
    
    return true;
  }

  public function setShipping()
  {

  }
}
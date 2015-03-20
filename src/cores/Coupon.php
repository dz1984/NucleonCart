<?php

namespace NucleonCart\Core;

class Coupon implements CouponInterface
{
  protected $id;
  protected $discount_price;

  public function _construct($id = -1, $discount_price = 0)
  {
    $this->id = $id;
    $this->discount_price = $discount_price;
  }

  public function getId()
  {
    return $this->id;
  }

  public function getDiscountPrice()
  {
    return $this->discount_price;
  }
}
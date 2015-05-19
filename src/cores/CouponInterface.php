<?php
namespace NucleonCart\Core;

interface CouponInterface
{
  public function getId();
  public function getDiscountPrice();
  public function apply(BillInterface $bill);
}
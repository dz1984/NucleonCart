<?php
namespace NucleonCart\Service;

use NucleonCart\Core\Coupon;

use NucleonCart\Core\BillInterface;
use NucleonCart\Core\CouponInterface;

class CouponService 
{

    public function _construct()
    {
    }

    public function findById($id = null)
    {
      if (is_null($id)) {
        return false;
      }

      return new Coupon($id);
    }

    public function findValidCoupons()
    {
      return array();
    }

    public function apply(BillInterface $bill = null, CouponInterface $coupon = null)
    {
      if (is_null($bill) || is_null($coupon)) {
        return false;
      }

      // TODO : insert the bussiness logic to check this coupon is valid.
       
      $bill->setCoupon($coupon);

      return true;
    }
}
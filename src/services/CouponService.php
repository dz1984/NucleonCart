<?php
namespace NucleonCart\Service;

use NucleonCart\Core\BillInterface;
use NucleonCart\Core\Coupon;
use NucleonCart\Core\CouponInterface;

class CouponService
{

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

    public function apply(BillInterface $bill = null, $coupons = null)
    {
        if ($this->_isNull($bill, $coupons)) {
            return false;
        }

        if ($coupons instanceof CouponInterface) {
            $coupons = array($coupons);
        }

        if (!is_array($coupons)) {
            return false;
        }

        foreach ($coupons as $coupon) {
            $is_valid_coupon = $this->isValidCoupon($bill, $coupon);

            if (!$is_valid_coupon) {
                continue;
            }
            // TODO : calculate discount on this coupon
            $discount_price = $coupon->getDiscountPrice();
            $total = $bill->getTotal() - $discount_price;

            $bill->setTotal($total);
            $bill->setCoupon($coupon);
        }

        return $bill;
    }

    private function _isNull($bill, $coupon)
    {
        return (is_null($bill) || is_null($coupon));
    }

    public function isValidCoupon(BillInterface $bill = null, CouponInterface $coupon = null)
    {
        if ($this->_isNull($bill, $coupon)) {
            return false;
        }

        // TODO : insert the business logic to check this coupon is valid.

        return true;
    }
}
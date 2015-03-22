<?php
namespace NucleonCart\Core;

class Bill implements BillInterface
{
    protected $total = 0;
    protected $coupon = array();

    public function setCoupon(CouponInterface $coupon = null)
    {
        if (is_null($coupon)) {
            return false;
        }

        $this->coupon[] = $coupon;

        return true;
    }

    public function getCoupon()
    {
        return $this->coupon;
    }

    public function setTotal($total = null)
    {
        if (is_null($total)) {
            return false;
        }

        $this->total = $total;

        return true;
    }

    public function getTotal()
    {
        return $this->total;
    }

    public function setShipping()
    {

    }
}
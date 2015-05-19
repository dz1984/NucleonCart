<?php
namespace NucleonCart\Core;

class Bill implements BillInterface
{
    protected $total = 0;
    protected $coupon = array();
    protected $shipping = null;
    protected $payment = null;

    public function __construct($total = null)
    {
        if (!is_null($total)) {
            $this->total = $total;
        }
    }

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

    public function setPayment(PaymentInterface $payment = null)
    {
        if (is_null($payment)) {
            return false;
        }

        $this->payment = $payment;

        return true;
    }

    public function getPayment()
    {
        return $this->payment;
    }

    public function setShipping(ShippingInterface $shipping = null)
    {
        if (is_null($shipping)) {
            return false;
        }

        $this->shipping = $shipping;

        return true;
    }

    public function getShipping()
    {
        return $this->shipping;
    }
}
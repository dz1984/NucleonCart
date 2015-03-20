<?php
namespace NucleonCart\Test;

use NucleonCart\Core\Bill;
use NucleonCart\Core\Coupon;
use NucleonCart\Service\CouponService;
use PHPUnit_Framework_TestCase;

class CouponServiceTest extends PHPUnit_Framework_TestCase
{
    protected $service;

    public function testInitial()
    {
        $this->assertInstanceOf('NucleonCart\Service\CouponService', $this->service);
    }

    public function testFindNoIdReturnFalse()
    {
        $result = $this->service->findById();

        $this->assertFalse($result);
    }

    public function testFindByIdReturnCoupon()
    {
        $result = $this->service->findById(1);

        $this->assertInstanceOf('NucleonCart\Core\Coupon', $result);
    }

    public function testFIndValidCouponsReturnArray()
    {
        $result = $this->service->findValidCoupons();

        $this->assertTrue(is_array($result));
    }

    public function testApplyNullBillReturnFalse()
    {
        $coupon = $this->_makeCoupon();

        $result = $this->service->apply(null, $coupon);

        $this->assertFalse($result);
    }

    private function _makeCoupon()
    {
        return new Coupon;
    }

    public function testApplyNullCouponReturnFalse()
    {
        $bill = $this->_makeBill();

        $result = $this->service->apply($bill, null);

        $this->assertFalse($result);

    }

    private function _makeBill()
    {
        return new Bill;
    }

    public function testApplyBothNullReturnFalse()
    {
        $result = $this->service->apply(null, null);

        $this->assertFalse($result);
    }

    public function testApplyReturnTrue()
    {
        $bill = $this->_makeBill();
        $coupon = $this->_makeCoupon();

        $result = $this->service->apply($bill, $coupon);

        $this->assertTrue($result);
    }

    protected function setUp()
    {
        $this->service = $this->_makeService();
    }

    private function _makeService()
    {
        return new CouponService();
    }
}
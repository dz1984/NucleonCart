<?php
namespace NucleonCart\Test;

use NucleonCart\Core\Bill;
use NucleonCart\Core\Coupon;
use NucleonCart\Service\CouponService;
use PHPUnit_Framework_TestCase;

class CouponServiceTest extends PHPUnit_Framework_TestCase
{
    protected $services;

    private function _getService()
    {
        return $this->services['default'];
    }

    public function testInitial()
    {
        $this->assertInstanceOf('NucleonCart\Service\CouponService', $this->_getService());
    }

    public function testFindNoIdReturnFalse()
    {
        $result = $this->_getService()->findById();

        $this->assertFalse($result);
    }

    public function testFindByIdReturnCoupon()
    {
        $result = $this->_getService()->findById(1);

        $this->assertInstanceOf('NucleonCart\Core\Coupon', $result);
    }

    public function testFIndValidCouponsReturnArray()
    {
        $result = $this->_getService()->findValidCoupons();

        $this->assertTrue(is_array($result));
    }

    public function testApplyNullBillReturnFalse()
    {
        $coupon = $this->_makeCoupon();

        $result = $this->_getService()->apply(null, $coupon);

        $this->assertFalse($result);
    }

    private function _makeCoupon()
    {
        return new Coupon;
    }

    private function _makeCouponList($num = 10)
    {
        $coupon_list = array();

        for ($i = 0; $i < $num; $i++) {
            $coupon_list[] = $this->_makeCoupon();
        }

        return $coupon_list;
    }

    public function testApplyNullCouponReturnFalse()
    {
        $bill = $this->_makeBill();

        $result = $this->_getService()->apply($bill, null);

        $this->assertFalse($result);

    }

    private function _makeBill()
    {
        return new Bill;
    }

    public function testApplyBothNullReturnFalse()
    {
        $result = $this->_getService()->apply(null, null);

        $this->assertFalse($result);
    }

    public function testApplyNonArrayCouponReturnFalse()
    {
        $bill = $this->_makeBill();

        $result = $this->_getService()->apply($bill, 'Non Array');

        $this->assertFalse($result);
    }

    public function testApplyPassOneNullCouponsReturnTrue()
    {
        $bill = $this->_makeBill();

        $coupon_list = $this->_makeCouponList();

        $coupon_list[] = null;

        $result = $this->_getService()->apply($bill, $coupon_list);

        $this->assertTrue($result);
    }
    public function testApplyReturnTrue()
    {
        $bill = $this->_makeBill();
        $coupon = $this->_makeCoupon();

        $result = $this->_getService()->apply($bill, $coupon);

        $this->assertTrue($result);
    }

    protected function setUp()
    {
        $this->services['default'] = $this->_makeService();
    }

    private function _makeService()
    {
        return new CouponService();
    }

    public function testApplyCouponListReturnTrue()
    {
        $bill = $this->_makeBill();
        $coupon_list = $this->_makeCouponList();

        $result = $this->_getService()->apply($bill, $coupon_list);

        $this->assertTrue($result);
    }

    public function testIsValidNullCouponReturnFalse()
    {
        $bill = $this->_makeBill();

        $result = $this->_getService()->isValidCoupon($bill, null);

        $this->assertFalse($result);
    }
}
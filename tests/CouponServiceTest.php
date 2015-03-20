<?php
namespace NucleonCart\Test;

use NucleonCart\Core\Bill;
use NucleonCart\Core\Coupon;

use NucleonCart\Service\CouponService;

use PHPUnit_Framework_TestCase;

class CouponServiceTest extends PHPUnit_Framework_TestCase
{
  private function _makeBill()
  {
    return new Bill;
  }

  private function _makeCoupon()
  {
    return new Coupon;
  }
  private function _makeService()
  {
    return new CouponService();
  }

  public function testInitial()
  {
    $service = $this->_makeService();

    $this->assertInstanceOf('NucleonCart\Service\CouponService', $service);
  }

  public function testFindNoIdReturnFalse()
  {
    $service = $this->_makeService();

    $result = $service->findById();

    $this->assertFalse($result);
  }

  public function testFindByIdReturnCoupon()
  {
    $service = $this->_makeService();

    $result = $service->findById(1);

    $this->assertInstanceOf('NucleonCart\Core\Coupon', $result);
  }

  public function testFIndValidCouponsReturnArray()
  {
    $service = $this->_makeService();

    $result = $service->findValidCoupons();

    $this->assertTrue(is_array($result));
  }

  public function testApplyNullBillReturnFalse()
  {
    $service = $this->_makeService();

    $coupon = $this->_makeCoupon();

    $result = $service->apply(null, $coupon);

    $this->assertFalse($result);
  }

  public function testApplyNullCouponReturnFalse()
  {
    $service = $this->_makeService();

    $bill = $this->_makeBill();

    $result = $service->apply($bill, null);

    $this->assertFalse($result);

  }

  public function testApplyBothNullReturnFalse()
  {

    $service = $this->_makeService();

    $result = $service->apply(null, null);

    $this->assertFalse($result);
  }

  public function testApplyReturnTrue()
  {
    $service = $this->_makeService();

    $bill = $this->_makeBill();
    $coupon = $this->_makeCoupon();

    $result = $service->apply($bill, $coupon);

    $this->assertTrue($result);
  }
}
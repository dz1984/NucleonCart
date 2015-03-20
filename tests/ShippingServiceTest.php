<?php
namespace NucleonCart\Test;

use NucleonCart\Core\Bill;
use NucleonCart\Core\Shipping;

use NucleonCart\Service\ShippingService;

use PHPUnit_Framework_TestCase;

class ShippingServiceTest extends PHPUnit_Framework_TestCase
{
  private function _makeBill()
  {
    return new Bill;
  }

  private function _makeShipping()
  {
    return new Shipping;
  }

  private function _makeService()
  {
    return new ShippingService();
  }

  public function testInitial()
  {
    $service = $this->_makeService();

    $this->assertInstanceOf('NucleonCart\Service\ShippingService', $service);
  }

  public function testApplyNullBillReturnFalse()
  {
    $service = $this->_makeService();

    $shipping = $this->_makeShipping();

    $result = $service->apply(null, $shipping);

    $this->assertFalse($result);
  }

  public function testApplyNullShippingReturnFalse()
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
    $shipping = $this->_makeShipping();

    $result = $service->apply($bill, $shipping);

    $this->assertTrue($result);
  }
}

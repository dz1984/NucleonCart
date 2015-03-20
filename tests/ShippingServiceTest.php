<?php
namespace NucleonCart\Test;

use NucleonCart\Core\Bill;
use NucleonCart\Core\Shipping;
use NucleonCart\Service\ShippingService;
use PHPUnit_Framework_TestCase;

class ShippingServiceTest extends PHPUnit_Framework_TestCase
{
    protected $service;

    public function testInitial()
    {
        $this->assertInstanceOf('NucleonCart\Service\ShippingService', $this->service);
    }

    public function testApplyNullBillReturnFalse()
    {
        $shipping = $this->_makeShipping();

        $result = $this->service->apply(null, $shipping);

        $this->assertFalse($result);
    }

    private function _makeShipping()
    {
        return new Shipping;
    }

    public function testApplyNullShippingReturnFalse()
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
        $shipping = $this->_makeShipping();

        $result = $this->service->apply($bill, $shipping);

        $this->assertTrue($result);
    }

    protected function setUp()
    {
        $this->service = $this->_makeService();
    }

    private function _makeService()
    {
        return new ShippingService();
    }
}

<?php
namespace NucleonCart\Test;

use NucleonCart\Core\Bill;
use NucleonCart\Core\Shipping;
use NucleonCart\Service\ShippingService;
use PHPUnit_Framework_TestCase;

class ShippingServiceTest extends PHPUnit_Framework_TestCase
{
    protected $services = array();

    private function _getService()
    {
        return $this->services['default'];
    }

    public function testInitial()
    {
        $this->assertInstanceOf('NucleonCart\Service\ShippingService', $this->_getService());
    }

    public function testApplyNullBillReturnFalse()
    {
        $shipping = $this->_makeShipping();

        $result = $this->_getService()->apply(null, $shipping);

        $this->assertFalse($result);
    }

    private function _makeShipping()
    {
        return new Shipping;
    }

    public function testApplyNullShippingReturnFalse()
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

    public function testApplyReturnTrue()
    {
        $bill = $this->_makeBill();
        $shipping = $this->_makeShipping();

        $result = $this->_getService()->apply($bill, $shipping);

        $this->assertTrue($result);
    }

    protected function setUp()
    {
        $this->services['default'] = $this->_makeService();
    }

    private function _makeService()
    {
        return new ShippingService();
    }
}

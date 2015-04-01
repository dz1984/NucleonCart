<?php

namespace NucleonCart\Test;

use NucleonCart\Service\PaymentService;

class PaymentServiceTest extends \PHPUnit_Framework_TestCase
{
    protected $services;

    private function _getService()
    {
        return $this->services['default'];
    }

    public function testInitial()
    {
        $this->assertInstanceOf('NucleonCart\Service\PaymentService', $this->_getService());
    }

    protected function setUp()
    {
        $this->services['default'] = $this->_makeService();
    }

    private function _makeService()
    {
        return new PaymentService();
    }

    public function testFindNullNameReturnFalse()
    {
        $result = $this->_getService()->findByName();

        $this->assertFalse($result);
    }

    public function testFindByNameReturnPayment()
    {
        $result = $this->_getService()->findByName('cash');

        $this->assertInstanceOf('NucleonCart\Core\Payment', $result);
    }
}

<?php
namespace NucleonCart\Test;

use NucleonCart\Service\OrderService;
use PHPUnit_Framework_TestCase;

class OrderServiceTest extends PHPUnit_Framework_TestCase
{
    protected $services = array();

    private function _getService()
    {
        return $this->services['default'];
    }

    public function testInitial()
    {
        $this->assertInstanceOf('NucleonCart\Service\OrderService', $this->_getService());
    }

    protected function setUp()
    {
        $this->services['default'] = $this->_makeService();
    }

    private function _makeService()
    {
        return new OrderService();
    }
}
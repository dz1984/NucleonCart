<?php
namespace NucleonCart\Test;

use NucleonCart\Service\OrderService;
use PHPUnit_Framework_TestCase;

class OrderServiceTest extends PHPUnit_Framework_TestCase
{
    protected $service;

    public function testInitial()
    {
        $this->assertInstanceOf('NucleonCart\Service\OrderService', $this->service);
    }

    protected function setUp()
    {
        $this->service = $this->_makeService();
    }

    private function _makeService()
    {
        return new OrderService();
    }
}
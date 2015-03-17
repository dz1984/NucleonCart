<?php
namespace NucleonCart\Test;

use NucleonCart\Service\OrderService;
use PHPUnit_Framework_TestCase;

class OrderServiceTest extends PHPUnit_Framework_TestCase
{
  
  private function _makeService()
  {
    return new OrderService();
  }

  public function testInitial()
  {
    $service = $this->_makeService();

    $this->assertInstanceOf('NucleonCart\Service\OrderService', $service);
  }
}
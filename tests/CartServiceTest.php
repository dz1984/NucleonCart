<?php
namespace NucleonCart\Test;

use NucleonCart\Service\CartService;
use PHPUnit_Framework_TestCase;

class CartServiceTest extends PHPUnit_Framework_TestCase
{
  
  private function _makeService()
  {
    return new CartService();
  }

  public function testInitial()
  {
    $service = $this->_makeService();

    $this->assertInstanceOf('NucleonCart\Service\CartService', $service);
  }
}
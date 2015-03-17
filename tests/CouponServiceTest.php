<?php
namespace NucleonCart\Test;

use NucleonCart\Service\CouponService;
use PHPUnit_Framework_TestCase;

class CouponServiceTest extends PHPUnit_Framework_TestCase
{
  
  private function _makeService()
  {
    return new CouponService();
  }

  public function testInitial()
  {
    $service = $this->_makeService();

    $this->assertInstanceOf('NucleonCart\Service\CouponService', $service);
  }
}
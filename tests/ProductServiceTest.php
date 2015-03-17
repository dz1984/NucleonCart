<?php
namespace NucleonCart\Test;

use NucleonCart\Service\ProductService;
use PHPUnit_Framework_TestCase;

class ProductServiceTest extends PHPUnit_Framework_TestCase
{
  
  private function _makeService()
  {
    return new ProductService();
  }

  public function testInitial()
  {
    $service = $this->_makeService();

    $this->assertInstanceOf('NucleonCart\Service\ProductService', $service);
  }
}
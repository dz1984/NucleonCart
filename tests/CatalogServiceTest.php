<?php
namespace NucleonCart\Test;

use NucleonCart\Service\CatalogService;
use PHPUnit_Framework_TestCase;

class CatalogServiceTest extends PHPUnit_Framework_TestCase
{
  
  private function _makeService()
  {
    return new CatalogService();
  }

  public function testInitial()
  {
    $service = $this->_makeService();

    $this->assertInstanceOf('NucleonCart\Service\CatalogService', $service);
  }
}
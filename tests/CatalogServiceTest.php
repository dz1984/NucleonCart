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

  public function testFindNoIdReturnNull()
  {
    $service = $this->_makeService();

    $result = $service->findProductById(null);

    $this->assertTrue(is_null($result));
  }

  public function testFindByIdReturnProduct()
  {
    $service = $this->_makeService();

    $result = $service->findProductById(1);

    $this->assertInstanceOf('NucleonCart\Core\Product', $result);
  }
}
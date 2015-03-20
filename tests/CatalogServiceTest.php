<?php
namespace NucleonCart\Test;

use NucleonCart\Service\CatalogService;
use PHPUnit_Framework_TestCase;

class CatalogServiceTest extends PHPUnit_Framework_TestCase
{
    protected $service;

    public function testInitial()
    {
        $this->assertInstanceOf('NucleonCart\Service\CatalogService', $this->service);
    }

    public function testFindNoIdReturnNull()
    {
        $result = $this->service->findProductById(null);

        $this->assertTrue(is_null($result));
    }

    public function testFindByIdReturnProduct()
    {
        $result = $this->service->findProductById(1);

        $this->assertInstanceOf('NucleonCart\Core\Product', $result);
    }

    protected function setUp()
    {
        $this->service = $this->_makeService();
    }

    private function _makeService()
    {
        return new CatalogService();
    }
}
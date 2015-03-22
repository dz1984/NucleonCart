<?php
namespace NucleonCart\Test;

use NucleonCart\Service\CatalogService;
use PHPUnit_Framework_TestCase;

class CatalogServiceTest extends PHPUnit_Framework_TestCase
{
    protected $services = array();

    public function testInitial()
    {
        $this->assertInstanceOf('NucleonCart\Service\CatalogService', $this->_getService());
    }

    private function _getService()
    {
        return $this->services['default'];
    }

    public function testFindNoIdReturnNull()
    {
        $result = $this->_getService()->findProductById(null);

        $this->assertTrue(is_null($result));
    }

    public function testFindByIdReturnProduct()
    {
        $result = $this->_getService()->findProductById(1);

        $this->assertInstanceOf('NucleonCart\Core\Product', $result);
    }

    protected function setUp()
    {
        $this->services['default'] = $this->_makeService();
    }

    private function _makeService()
    {
        return new CatalogService();
    }
}
<?php
namespace NucleonCart\Test;

use NucleonCart\Core\Cart;
use NucleonCart\Service\CartService;
use NucleonCart\Service\CatalogService;

use PHPUnit_Framework_TestCase;

/**
 *
 * Shopping process:
 * 
 * Add Item -> Use Coupon -> Choice Payment -> Choice Shipping -> Checkout Order
 */
class ProcessTest extends PHPUnit_Framework_TestCase
{

  private $services = array();

  private function _initService()
  {
    $this->services['cart'] = new CartService(new Cart());
    $this->services['catalog'] = new CatalogService();
  }

  public function setUp()
  {
    $this->_initService();
  }

  public function testInitail()
  {
    $this->assertTrue(is_array($this->services));
    $this->assertInstanceOf('NucleonCart\Service\CartService', $this->services['cart']);
    $this->assertInstanceOf('NucleonCart\Service\CatalogService', $this->services['catalog']);
  }

  public function testAddItem()
  {
    $product = $this->services['catalog']
                    ->findProductById(1);

    $this->services['cart']->add($product);

    $result = $this->services['cart']->count();
    $this->assertEquals(1, $result);
  }
}
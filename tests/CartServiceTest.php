<?php
namespace NucleonCart\Test;

use NucleonCart\Service\CartService;
use NucleonCart\Core\Cart;
use NucleonCart\Core\Product;

use PHPUnit_Framework_TestCase;

class MockProduct extends Product
{


}

class CartServiceTest extends PHPUnit_Framework_TestCase
{
  private function _makeMockProduct($id = 1, $price = 100)
  {
    return new MockProduct($id, $price);
  }

  private function _makeCartInstance()
  {
    return new Cart();
  }

  private function _makeService()
  {
    $cart = $this->_makeCartInstance();

    return new CartService($cart);
  }

  public function testInitial()
  {
    $service = $this->_makeService();

    $this->assertInstanceOf('NucleonCart\Service\CartService', $service);
  }

  public function testAddItemReturnFalse()
  {
    $service = $this->_makeService();

    $result = $service->add();

    $this->assertFalse($result);
  }

  public function testAddItemReturnTrue()
  {
    $service = $this->_makeService();
    $product = $this->_makeMockProduct();

    $result = $service->add($product);

    $this->assertTrue($result);
  }
}
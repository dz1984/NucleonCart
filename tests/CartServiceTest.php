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

  private function _makeMockProductList($num = 10, $is_rand = true, $is_all_same = false)
  {
    $product_list = array();

    for ($i=1; $i <= $num; $i++) {
      $id = ($is_rand) ? rand() : $i;
      $product_list[] = ($is_all_same) ? $this->_makeMockProduct() : $this->_makeMockProduct($id);
    }

    return $product_list;
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

  private function _makeExistOneItemService()
  {
    $product = $this->_makeMockProduct();

    $service = $this->_makeService();

    $service->add($product);

    return $service;
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

  public function testAddManyItemsReturnTrue()
  {
    $service = $this->_makeService();
    $product_list = $this->_makeMockProductList();

    $result = true;

    foreach($product_list as $product) {
      $result = ($result && $service->add($product));
    }

    $this->assertTrue($result);
  }

  public function testAddSameItemsReturnTrue()
  {
    $service = $this->_makeService();

    $product_list = $this->_makeMockProductList($is_rand = false);

    $result = true;

    foreach($product_list as $product) {
      $result = ($result && $service->add($product));
    }

    $this->assertTrue($result);

  }

  public function testRemoveNullItemReturnFalse()
  {
    $service = $this->_makeExistOneItemService();

    $result = $service->remove();

    $this->assertFalse($result);
  }

  public function testRemoveNoSameItemReturnFalse()
  {
    $service = $this->_makeExistOneItemService();

    $another_prouct = $this->_makeMockProduct(2, 100);

    $result = $service->remove($another_prouct);

    $this->assertFalse($result);
  }

  public function testRemoveSameItemReturnTrue()
  {
    $service = $this->_makeService();

    $product = $this->_makeMockProduct();

    $service->add($product);

    $result = $service->remove($product);

    $this->assertTrue($result);
  }

  public function testCountReturnNumber()
  {
    $service = $this->_makeExistOneItemService();

    $result = $service->count();

    $this->assertTrue(is_numeric($result));
    $this->assertGreaterThan(0, $result);
  }

  public function testCountSameItemsReturnAmount()
  {
    $service = $this->_makeService();

    $product_list = $this->_makeMockProductList($num = 20, $is_all_same = true);

    foreach($product_list as $product) {
      $service->add($product);
    }

    $id = $product_list[0]->getId();

    $result = $service->count($id);
    $this->assertGreaterThan(0, $result);
    $this->assertEquals(20, $result);
  }
}
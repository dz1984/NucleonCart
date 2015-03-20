<?php
namespace NucleonCart\Test;

use NucleonCart\Core\Cart;
use NucleonCart\Core\Product;
use NucleonCart\Service\CartService;
use PHPUnit_Framework_TestCase;

class MockProduct extends Product
{


}

class CartServiceTest extends PHPUnit_Framework_TestCase
{

    protected $has_item_service;
    protected $service;

    protected function setUp()
    {
        $this->service = $this->_makeService();
        $this->has_item_service = $this->_makeExistOneItemService();
    }

    private function _makeService()
    {
        $cart = $this->_makeCartInstance();

        return new CartService($cart);
    }

    private function _makeCartInstance()
    {
        return new Cart();
    }

    private function _makeExistOneItemService()
    {
        $product = $this->_makeMockProduct();

        $service = $this->_makeService();

        $service->add($product);

        return $service;
    }

    private function _makeMockProduct($id = 1, $price = 100)
    {
        return new MockProduct($id, $price);
    }

    public function testInitial()
    {
        $this->assertInstanceOf('NucleonCart\Service\CartService', $this->service);
        $this->assertInstanceOf('NucleonCart\Service\CartService', $this->has_item_service);
    }

    public function testAddItemReturnFalse()
    {
        $result = $this->service->add();

        $this->assertFalse($result);
    }

    public function testAddItemReturnTrue()
    {
        $product = $this->_makeMockProduct();

        $result = $this->service->add($product);

        $this->assertTrue($result);
    }

    public function testAddManyItemsReturnTrue()
    {
        $product_list = $this->_makeMockProductList();

        $result = true;

        foreach ($product_list as $product) {
            $result = ($result && $this->service->add($product));
        }

        $this->assertTrue($result);
    }

    private function _makeMockProductList($num = 10, $is_rand = true, $is_all_same = false)
    {
        $product_list = array();

        for ($i = 1; $i <= $num; $i++) {
            $id = ($is_rand) ? rand() : $i;
            $product_list[] = ($is_all_same) ? $this->_makeMockProduct() : $this->_makeMockProduct($id);
        }

        return $product_list;
    }

    public function testAddSameItemsReturnTrue()
    {
        $product_list = $this->_makeMockProductList($is_rand = false);

        $result = true;

        foreach ($product_list as $product) {
            $result = ($result && $this->service->add($product));
        }

        $this->assertTrue($result);
    }

    public function testRemoveNullItemReturnFalse()
    {
        $result = $this->has_item_service->remove();

        $this->assertFalse($result);
    }

    public function testRemoveNoSameItemReturnFalse()
    {
        $another_product = $this->_makeMockProduct(2, 100);

        $result = $this->has_item_service->remove($another_product);

        $this->assertFalse($result);
    }

    public function testRemoveSameItemReturnTrue()
    {
        $product = $this->_makeMockProduct();

        $this->service->add($product);

        $result = $this->service->remove($product);

        $this->assertTrue($result);
    }

    public function testCountReturnNumber()
    {
        $result = $this->has_item_service->count();

        $this->assertTrue(is_numeric($result));
        $this->assertGreaterThan(0, $result);
    }

    public function testCountSameItemsReturnAmount()
    {
        $product_list = $this->_makeMockProductList($num = 20, $is_all_same = true);

        foreach ($product_list as $product) {
            $this->service->add($product);
        }

        $id = $product_list[0]->getId();

        $result = $this->service->count($id);
        $this->assertGreaterThan(0, $result);
        $this->assertEquals(20, $result);
    }

    public function testCheckout()
    {
        $result = $this->has_item_service->checkout();

        $this->assertInstanceOf('NucleonCart\Core\Bill', $result);
    }
}
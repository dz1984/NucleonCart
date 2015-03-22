<?php
namespace NucleonCart\Test;

use NucleonCart\Core\Cart;
use NucleonCart\Service\CartService;
use NucleonCart\Service\CatalogService;
use NucleonCart\Service\CouponService;
use PHPUnit_Framework_TestCase;

/**
 *
 * Shopping process:
 *
 * Add Item -> Use Coupon -> Choice Payment -> Choice Shipping -> Checkout Order
 */
class ProcessTest extends PHPUnit_Framework_TestCase
{

    protected static $services = array();

    private function _getService($service_name = null)
    {
        if (is_null($service_name)) {
            return self::$services;
        }

        if (array_key_exists($service_name, self::$services)) {
            return self::$services[$service_name];
        }

        return false;
    }

    private static function _initService()
    {
        self::$services['cart'] = new CartService(new Cart());
        self::$services['catalog'] = new CatalogService();
        self::$services['coupon'] = new CouponService();
    }

    public static function setUpBeforeClass()
    {
        self::_initService();
    }

    public function testInitial()
    {
        $this->assertTrue(is_array($this->_getService()));
        $this->assertInstanceOf('NucleonCart\Service\CartService', $this->_getService('cart'));
        $this->assertInstanceOf('NucleonCart\Service\CatalogService', $this->_getService('catalog'));
        $this->assertInstanceOf('NucleonCart\Service\CouponService', $this->_getService('coupon'));
    }

    /**
     * @depends testInitial
     * @return [type] [description]
     */
    public function testAddItem()
    {
        $product = $this->_getService('catalog')
            ->findProductById(1);

        $this->_getService('cart')->add($product);

        $result = $this->_getService('cart')->count();
        $this->assertEquals(1, $result);

        $bill = $this->_getService('cart')->checkout();

        return $bill;
    }

    /**
     * @depends testAddItem
     * @return [type] [description]
     */
    public function testUseCoupon($bill)
    {
        $coupon = $this->_getService('coupon')->findById(1);

        $result = $this->_getService('coupon')->apply($bill, $coupon);

        $this->assertTrue($result);

        return $bill;
    }

    /**
     * @depends testUseCoupon
     */
    public function testChoicePayment($bill)
    {
        $this->assertTrue(true);

        return $bill;
    }

    /**
     * @depends testChoicePayment
     */
    public function testChoiceShipping($bill)
    {
        $this->assertTrue(true);

        return $bill;
    }

    /**
     * @depends testChoiceShipping
     */
    public function testCheckoutOrder($bill)
    {
        $this->assertTrue(true);
    }
}
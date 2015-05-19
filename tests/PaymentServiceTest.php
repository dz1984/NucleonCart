<?php

namespace NucleonCart\Test;

use NucleonCart\Core\Bill;
use NucleonCart\Service\PaymentService;

class PaymentServiceTest extends \PHPUnit_Framework_TestCase
{
    protected $services;

    private function _getService()
    {
        return $this->services['default'];
    }

    public function testInitial()
    {
        $this->assertInstanceOf('NucleonCart\Service\PaymentService', $this->_getService());
    }

    protected function setUp()
    {
        $this->services['default'] = $this->_makeService();
    }

    private function _makeService()
    {
        return new PaymentService();
    }

    public function testFindNullNameReturnFalse()
    {
        $result = $this->_getService()->findByName();

        $this->assertFalse($result);
    }

    public function testFindByNameReturnPayment()
    {
        $expect_payment = 'cash';
        $result = $this->_getService()->findByName($expect_payment);

        $this->assertInstanceOf('NucleonCart\Core\Payment', $result);
        $this->assertEquals($result->getName(), $expect_payment);
    }

    public function testApplyAllNullReturnFalse()
    {
        $result = $this->_getService()->apply(null, null);
        $this->assertFalse($result);
    }

    public function testApplyOnlyBillNullReturnFalse()
    {
        $payment = $this->_makePayment();
        $result = $this->_getService()->apply(null, $payment);

        $this->assertFalse($result);    
    }

    public function testApplyOnlyPaymentNullReturnFalse()
    {
        $bill = $this->_makeBill();

        $result = $this->_getService()->apply($bill, null);

        $this->assertFalse($result);
    }

    public function testApplyReturnBill()
    {
        $bill = $this->_makeBill();
        $payment = $this->_makePayment();

        $result = $this->_getService()->apply($bill, $payment);

        $this->assertInstanceOf('NucleonCart\Core\BillInterface', $result);
    }

    public function testAfterApplyReturnCorrectPayment()
    {
        $bill = $this->_makeAfterApplyBill();

        $result = $bill->getPayment();

        $this->assertInstanceOf('NucleonCart\Core\PaymentInterface', $result);
    }

    public function testAfterApplyReturnCorrectPaymentName()
    {
        $bill = $this->_makeAfterApplyBill();
        $catch_payment_from_bill = $bill->getPayment();
        $result = $catch_payment_from_bill->getName();

        $this->assertEquals('cash', $result);
    }

    private function _makeAfterApplyBill()
    {
        $bill = $this->_makeBill();
        $payment = $this->_makePayment();

        return $this->_getService()->apply($bill, $payment);
    }

    private function _makePayment($payment = null)
    {
        if (is_null($payment)) {
            $payment = 'cash';
        }

        return $this->_getService()->findByName($payment);
    }

    private function _makeBill()
    {
        return new Bill;
    }
}

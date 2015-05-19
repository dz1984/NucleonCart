<?php

namespace NucleonCart\Service;

use NucleonCart\Core\BillInterface;
use NucleonCart\Core\Payment;


class PaymentService
{

    public function findByName($name = null)
    {
        if (is_null($name)) {
            return false;
        }

        return new Payment($name);
    }

    private function _isNull($bill, $payment)
    {
        return (is_null($bill) || is_null($payment));
    }

    public function apply(BillInterface $bill = null, $payment = null)
    {
        if ($this->_isNull($bill, $payment)) {
            return false;
        }

        return $payment->apply($bill);
    }

    public function isValidPayment(BillInterface $bill = null, PaymentInterface $payment = null)
    {
        if ($this->_isNull($bill, $payment)) {
            return false;
        }

        // TODO : insert the business logic to check this payment is valid.

        return true;
    }
}
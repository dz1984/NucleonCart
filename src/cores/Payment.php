<?php

namespace NucleonCart\Core;

class Payment implements PaymentInterface
{
    protected $name;

    public function __construct($name = null)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function apply(BillInterface $bill)
    {
        $bill->setPayment($this);
        
        return $bill;
    }
}
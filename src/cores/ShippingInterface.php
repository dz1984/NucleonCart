<?php
namespace NucleonCart\Core;

interface ShippingInterface
{
    public function getName();
    public function apply(BillInterface $bill);
}

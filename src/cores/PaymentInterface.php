<?php

namespace NucleonCart\Core;


interface PaymentInterface
{
  public function getName();
  public function apply(BillInterface $bill);
}
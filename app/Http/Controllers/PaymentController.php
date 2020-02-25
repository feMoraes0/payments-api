<?php

namespace App\Http\Controllers;

use App\Payment;

class PaymentController extends Controller
{
  private $payment;
  
  public function __construct()
  {
    $this->payment = new Payment();
  }

  
}

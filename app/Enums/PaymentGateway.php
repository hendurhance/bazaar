<?php

namespace App\Enums;

enum PaymentGateway: int {
    case STRIPE = 0;
    case PAYSTACK = 1;
    case FLUTTERWAVE = 2;
}
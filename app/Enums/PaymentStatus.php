<?php

namespace App\Enums;

enum PaymentStatus: int 
{
    case INITIATED = 0;
    case PENDING = 1;
    case SUCCESS = 2;
    case FAILED = 3;
    case DECLINED = 4;
    case DISPUTE = 5;
}
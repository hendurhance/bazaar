<?php

namespace App\Enums;

enum AdStatus: int 
{
    case PENDING = 0;
    case PUBLISHED = 1;
    case REJECTED = 2;
    case EXPIRED = 3;
    case ARCHIVED = 4;
}
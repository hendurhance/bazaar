<?php

namespace App\Enums;

enum MediaType: int 
{
    case IMAGE = 0;
    case FILE = 1;
    case VIDEO = 2;
    case OTHER = 3;
}
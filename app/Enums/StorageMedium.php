<?php

namespace App\Enums;

enum StorageMedium: int {
    case LOCAL = 0;
    case S3 = 1;
}
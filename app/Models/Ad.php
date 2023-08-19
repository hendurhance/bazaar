<?php

namespace App\Models;

use App\Traits\HasMedia;
use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory, HasMedia, HasSlug;
}

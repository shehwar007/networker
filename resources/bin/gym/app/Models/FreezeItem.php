<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FreezeItem extends Model
{
    use HasFactory;
    protected $table = "freeze_items";
    protected $guarded = [];

    
}

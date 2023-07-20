<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "services";
    protected $guarded = [];
    public const VALIDATION_RULES = [

        'service_title' => 'required',
        'service_price' => 'required',
        'service_category' => 'required',
        'service_type' => 'required',
        'service_duration' => 'required_if:service_type,==,Monthly',
        'service_icon' => 'nullable',
        'service_description' => 'nullable',
        'status' => 'required|in:Active,Inactive',

    ];
}

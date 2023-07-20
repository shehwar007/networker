<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "members";
    protected $guarded = [];

    public const VALIDATION_RULES = [
        'member_no' => 'required',
        'member_name' => 'required',
        'member_mobile' => 'required',
        'member_network' => 'nullable',
        'member_gender' => 'required',
        'member_nic' => 'required',
        'member_category' => 'nullable',
        'member_fathername' => 'nullable',
        'member_dob' => 'nullable',
        'member_image' => 'nullable',
        'member_residence' => 'nullable',
        'member_address' => 'nullable',
        'member_email' => 'nullable',
        'member_emergencyno' => 'nullable',
        'member_registrationdate' => 'nullable',
        'member_registerby' => 'nullable',
    ];


    public function order_info()
    {
        return $this->hasMany(Sale::class)->orderBy('created_at','desc');
    }

}

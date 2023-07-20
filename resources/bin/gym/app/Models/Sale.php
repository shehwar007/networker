<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function member(){

        return $this->belongsTo(Member::class);
    }
    public function paymentinfo()
    {
        return $this->hasMany(SalePayment::class);
    }
    public function saleinfo()
    {
        return $this->hasMany(SaleItem::class)->orderBy('created_at','desc');
    }
}

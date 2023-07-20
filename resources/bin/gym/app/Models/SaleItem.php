<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
    use HasFactory;
    protected $table = "sale_items";
    protected $guarded = [];

    public function service()
    {

        return $this->belongsTo(Service::class);
    }

    
    public function orderinfo()
    {

        return $this->belongsTo(Sale::class,'sale_id')->orderBy('created_at','desc');
    }

    public function freezeinfo()
    {
        return $this->hasMany(FreezeItem::class,'sale_item_id')->latest('id')->take(1);
    }

    
 
   
}

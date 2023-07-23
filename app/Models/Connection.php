<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Connection extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded=[];

    public function getIsIndividualAttribute($value)
    {
        if($value==1){
           return "Individual";
        }else{
            return "Organization";
        }
   
    }

    public function contype(){
        return $this->belongsTo(ConnectionType::class,'connection_type_id');
    }

    public function conactivity(){
        return $this->belongsTo(Activity::class,'activity_id');
    }

    public function conhelp(){
        return $this->belongsTo(ConnectionHelp::class,'connection_help_id');
    }
   
}
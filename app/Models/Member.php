<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $guarded=[];

    protected $table = 'connection_teams';

    public function team_data(){
        return $this->belongsTo(Team::class,'team_id');
    }
    public function member_data(){
        return $this->belongsTo(Connection::class,'member_id');
    }
}

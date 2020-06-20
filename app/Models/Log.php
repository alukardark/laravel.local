<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    //    protected $table='logs'; //name_table
    protected $guarded = [];

    public function scopeStatus($query, $val){
        return $query->where('status', $val);
    }
}

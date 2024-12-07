<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Magazine extends Model
{
    protected $fillable = ['caliber','capacity','weapon_id','in_stock','model_magazine'];

    public function movements(){
        return $this->hasMany(Movement::class);
    }
    public function weapons(){
        return $this->belongsTo(Weapon::class);
    }
}
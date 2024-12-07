<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Weapon extends Model
{
    protected $fillable = ['model','weaponType_id','manufacturer','state'];

    public function weaponTypes(){
        return $this->belongsTo(WeaponType::class);
    }
    public function magazines(){
        return $this->hasMany(Magazine::class);
    }
}

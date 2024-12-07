<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeaponLicense extends Model
{
    protected $fillable = ['name','weapon_id','weaponType_id'];
    
    public function militaries(){
        return $this->hasMany(Military::class);
    }
    public function weapons(){
        return $this->belongsTo(Weapon::class);
    }
    public function weaponTypes(){
        return $this->belongsTo(WeaponType::class);
    }
}

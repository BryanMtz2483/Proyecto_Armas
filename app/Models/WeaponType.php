<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeaponType extends Model
{
    protected $fillable = ['category','description'];
    
    public function weapons(){
        return $this->hasMany(Weapon::class);
    }
    public function magazines(){
        return $this->hasMany(Magazine::class);
    }
}


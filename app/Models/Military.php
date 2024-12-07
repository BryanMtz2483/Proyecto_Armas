<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Military extends Model
{
    protected $fillable = ['name','email','phone','birth_date','join_date','credential_id','weaponLicense_id'];

    public function movements(){
        return $this->hasMany(Movement::class);
    }
    public function credentials(){
        return $this->belongsTo(Credential::class);
    }
    public function weaponLicenses(){
        return $this->belongsToMany(WeaponLicense::class);
    }
}

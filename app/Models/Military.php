<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;

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
    public static function validationRules(){
        return[
            'name'=>'string|required|max:50',
            'email'=>'string|required|max:50',
            'phone'=>'integer|required',
            'birth_date'=>'date|required',
            'join_date'=>'date|required',
            'credential_id'=>'integer|required|max:50',
            'weaponLicense_id'=>'integer|required|max:50',
        ];
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeaponLicense extends Model
{
    protected $fillable = ['name','description'];
    
    public function militaries(){
        return $this->hasMany(Military::class);
    }
    public static function validationRules(){
        return[
            'name'=>'string|required|max:50',
            'description'=>'required',
        ];
    }
}

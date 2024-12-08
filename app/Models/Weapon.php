<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Weapon extends Model
{
    protected $fillable = ['model','code','weaponType_id','type_magazine','manufacturer','state'];

    public function weaponTypes(){
        return $this->belongsTo(WeaponType::class);
    }
    public function magazines(){
        return $this->hasMany(Magazine::class);
    }
    public function militaries(){
        return $this->hasMany(Military::class);
    }
    public static function validationRules(){
        return[
            'model'=>'string|required|max:50',
            'code'=>'string|required|max:50',
            'weaponType_id'=>'integer|required|max:50',
            'type_magazine'=>'string|required|max:50',
            'manufacturer'=>'string|required|max:50',
            'state'=>'required',
        ];
    }
}

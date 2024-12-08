<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Magazine extends Model
{
    protected $fillable = ['caliber','capacity','weapon_id','state','model_magazine'];

    public function movements(){
        return $this->hasMany(Movement::class);
    }
    public function weapons(){
        return $this->belongsTo(Weapon::class);
    }
    public static function validationRules(){
        return[
            'caliber'=>'string|required',
            'capacity'=>'integer|required',
            'weapon_id'=>'integer|required|max:50',
            'state'=>'required',
            'model_magazine'=>'string|required|max:50',
        ];
    }
}
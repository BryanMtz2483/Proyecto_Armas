<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Magazine extends Model
{
    protected $fillable = ['code','caliber','capacity','state','type_magazine'];

    public function movements(){
        return $this->hasMany(Movement::class);
    }
    public function magazine_types(){
        return $this->belongsTo(MagazineType::class);
    }
    public static function validationRules(){
        return[
            'code'=>'string|required',
            'caliber'=>'string|required',
            'capacity'=>'integer|required',
            'state'=>'required',
            'type_magazine'=>'string|required|max:50',
        ];
    }
}
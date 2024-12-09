<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{
    protected $fillable = ['military_id','weapon_code','magazine_code','base_id','date','reason'];

    public function militaries(){
        return $this->belongsTo(Military::class);
    }
    public function weapon(){
        return $this->belongsTo(Weapon::class);
    }
    public function magazine(){
        return $this->belongsTo(Magazine::class);
    }
    public function bases(){
        return $this->belongsTo(Base::class);
    }
    public static function validationRules(){
        return[
            'military_id'=>'integer|required',
            'weapon_code'=>'integer|required',
            'magazine_code'=>'integer|required',
            'base_id'=>'integer|required',
            'date'=>'date|required',
            'reason'=>'required',
        ];
    }
}

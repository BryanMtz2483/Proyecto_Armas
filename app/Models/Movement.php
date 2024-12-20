<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{
    protected $fillable = ['military_id','weapon_id','magazine_id','base_id','date','reason'];

    public function military(){
        return $this->belongsTo(Military::class);
    }
    public function weapon(){
        return $this->belongsTo(Weapon::class);
    }
    public function magazine(){
        return $this->belongsTo(Magazine::class);
    }
    public function base(){
        return $this->belongsTo(Base::class);
    }
    public static function validationRules()
    {
        return [
            'military_id' => 'integer|required',
            'weapon_id' => 'integer|required',
            'magazine_id' => 'integer|required',
            'base_id' => 'integer|required',
            'date' => 'date|required',
            'reason' => 'required|string|max:255',
        ];
    }

}

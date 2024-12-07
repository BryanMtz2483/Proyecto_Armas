<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{
    protected $fillable = ['military_id','weapon_id','magazine_id','base_id','date','reason'];

    public function militaries(){
        return $this->belongsTo(Military::class);
    }
    public function weapons(){
        return $this->belongsTo(Weapon::class);
    }
    public function magazines(){
        return $this->belongsTo(Magazine::class);
    }
    public function bases(){
        return $this->belongsTo(Base::class);
    }
}

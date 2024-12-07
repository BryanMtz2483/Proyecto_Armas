<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Credential extends Model
{
    protected $fillable = ['name','rank_id','base_id','emision','expiration'];

    public function militaries(){
        return $this->hasMany(Military::class);
    }
    public function ranks(){
        return $this->belongsTo(Rank::class);
    }
    public function bases(){
        return $this->belongsTo(Base::class);
    }
}

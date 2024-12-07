<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Base extends Model
{
    protected $fillable = ['name','location'];

    public function credentials(){
        return $this->hasMany(Credential::class);
    }
    public function movements(){
        return $this->hasMany(Movement::class);
    }
    public static function validationRules(){
        return[
            'name'=>'string|required|max:50',
            'location'=>'string|required|max:50',
        ];
    }
}

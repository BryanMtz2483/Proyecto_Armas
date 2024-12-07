<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rank extends Model
{
    protected $fillable = ['name','level'];

    public function credentials(){
        return $this->hasMany(Credential::class);
    }
    public static function validationRules(){
        return[
            'name'=>'string|required|max:50',
            'level'=>'integer|required|max:50',
        ];
    }
}

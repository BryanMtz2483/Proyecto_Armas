<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MagazineType extends Model
{
    protected $fillable = ['name', 'description'];

    public function magazines(){
        return $this->hasMany(Magazine::class);
    }
    public static function validationRules(){
        return[
            'name'=>'string|required|max:50',
            'description'=>'required',
        ];
    }
}

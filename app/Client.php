<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{

    protected $guarded = [];

    protected $casts = [
        'phone' => 'array'
    ];

    public function getNameAttribute($value){

      return ucfirst($value);
    }//end of ucase

public function orders(){

    return $this->hasMany(Order::class);

}//end of orders


}//end of model

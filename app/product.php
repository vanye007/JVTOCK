<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
   protected $table = 'product';

   public function Specifications()
    {
        return $this->hasMany('App\product_specifications');
    }
}

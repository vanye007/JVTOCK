<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class supplier_info extends Model
{
    public function business_info(){
      return $this->hasMany('App\business_info','supplier_infos_id');
    }

    public function facility_info(){
      return $this->hasManyThrough('App\facility_info','App\business_info','supplier_infos_id','business_infos_id');
    }
}

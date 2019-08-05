<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
   /**
     * The attributes that are mass assignable.
     *
     * @var array
    */

    protected $fillable = [
        'name', 'vendor_code', 'price'
      ];
  
      public function orders()
      {
        return $this->belongsToMany('App\Order');
      }
}

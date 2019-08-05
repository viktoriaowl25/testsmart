<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */

    public $timestamps = true;

    protected $fillable = [
        'status_id', 'user_id',
      ];
  
  
    public function products()
    {
        return $this->belongsToMany('App\Product');
    }

    public function status()
    {
      return $this->belongsTo('App\Status');
    }

    public function user()
    {
      return $this->belongsTo('App\User');
    }
}

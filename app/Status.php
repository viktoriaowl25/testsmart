<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public $timestamps = false;

    protected $fillable = [
        'title',
    ];

    public function orders()
    {
      return $this->hasMany('App\Order');
    }
}

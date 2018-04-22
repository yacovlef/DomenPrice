<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
  protected $fillable = [
      'slug', 'name',
  ];

  public function prices()
  {
    return $this->hasMany('App\Price');
  }
}

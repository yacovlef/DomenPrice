<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registrar extends Model
{
  protected $fillable = [
      'slug', 'name', 'logo', 'www',
  ];

  public function prices()
  {
    return $this->hasMany('App\Price');
  }
}

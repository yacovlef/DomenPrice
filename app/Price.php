<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
  public function domain()
  {
      return $this->belongsTo('App\Domain');
  }

  public function registrar()
  {
      return $this->belongsTo('App\Registrar');
  }
}

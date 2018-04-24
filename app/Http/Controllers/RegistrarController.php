<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Registrar;

class RegistrarController extends Controller
{
  public function index()
  {
    $registrars = Registrar::withCount('prices')->orderBy('prices_count', 'desc')->paginate(10);

    return view('registrar.index',[
      'registrars' => $registrars,
    ]);
  }

  public function show($slug)
  {
    $registrar = Registrar::where('slug', $slug)->firstOrFail();

    $prices = $registrar->prices()->orderBy('price')->paginate(10);

    return view('registrar.show',[
      'registrar' => $registrar,
      'prices' => $prices,
    ]);
  }
}

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

  }
}

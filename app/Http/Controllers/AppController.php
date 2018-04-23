<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Domain;

class AppController extends Controller
{
  public function index()
  {
    $domains = Domain::withCount('prices')->orderBy('prices_count', 'desc')->paginate(10);

    return view('index',[
      'domains' => $domains,
    ]);
  }
}

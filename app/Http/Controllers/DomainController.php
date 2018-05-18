<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Domain;

class DomainController extends Controller
{
  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($slug)
  {
    $domain = Domain::where('slug', $slug)->firstOrFail();

    $prices = $domain->prices()->orderBy('price')->paginate(20);

    return view('domain.show',[
      'domain' => $domain,
      'prices' => $prices,
    ]);
  }
}

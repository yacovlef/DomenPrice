<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Price;
use App\Domain;
use App\Registrar;

class PriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $prices = Price::paginate(10);

      return view('admin.price.index',[
        'prices' => $prices,
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $domains = Domain::all();
      $registrars = Registrar::all();

      return view('admin.price.create', [
        'domains' => $domains,
        'registrars' => $registrars,
      ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $request->validate([
        'price' => 'required|integer|max:2147483647',
        'domain' => 'required',
        'registrar' => 'required',
      ]);

      $domain = Domain::findOrFail($request->input('domain'));
      $registrar = Registrar::findOrFail($request->input('registrar'));

      $price = new Price;
      $price->price = $request->input('price');
      $price->domain()->associate($domain);
      $price->registrar()->associate($registrar);
      $price->save();

      return redirect()->route('admin.prices.index')->with('status', 'Цена добавлена!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $price = Price::findOrFail($id);

      $domains = Domain::all();
      $registrars = Registrar::all();

      return view('admin.price.edit',[
        'price' => $price,
        'domains' => $domains,
        'registrars' => $registrars,
      ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $price = Price::findOrFail($id);

      $request->validate([
        'price' => 'required|integer|max:2147483647',
        'domain' => 'required',
        'registrar' => 'required',
      ]);

      $domain = Domain::findOrFail($request->input('domain'));
      $registrar = Registrar::findOrFail($request->input('registrar'));

      $price->price = $request->input('price');
      $price->domain()->associate($domain);
      $price->registrar()->associate($registrar);
      $price->save();

      return redirect()->route('admin.prices.index')->with('status', 'Цена отредактирована!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $price = Price::findOrFail($id)->delete();

      return redirect()->route('admin.prices.index')->with('status', 'Цена удалёна!');
    }
}

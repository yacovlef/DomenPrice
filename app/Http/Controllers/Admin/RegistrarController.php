<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

use App\Registrar;

class RegistrarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $registrars = Registrar::paginate(10);

      return view('admin.registrar.index',[
        'registrars' => $registrars,
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('admin.registrar.create');
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
        'slug' => 'required|max:255|unique:registrars',
        'name' => 'required|max:255|unique:registrars',
        'logo' => 'required|image|max:255',
        'www' => 'required|url|max:255|unique:registrars',
      ]);

      $registrar = Registrar::create([
          'slug' => $request->input('slug'),
          'name' => $request->input('name'),
          'logo' => $request->file('logo')->store('public/registrar/avatar'),
          'www' => $request->input('www'),
      ]);

      return redirect()->route('admin.registrars.index')->with('status', 'Регистратор добавлен!');
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
      $registrar = Registrar::findOrFail($id);

      return view('admin.registrar.edit',[
        'registrar' => $registrar,
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
      $registrar = Registrar::findOrFail($id);

      $request->validate([
        'slug' => 'required|max:255',
        'slug' => Rule::unique('registrars')->ignore($registrar->id, 'id'),
        'name' => 'required|max:255',
        'name' => Rule::unique('registrars')->ignore($registrar->id, 'id'),
        'logo' => 'required|image|max:255',
        'www' => 'required|url|max:255',
        'www' => Rule::unique('registrars')->ignore($registrar->id, 'id'),
      ]);

      $registrar->update([
        'slug' => $request->input('slug'),
        'name' => $request->input('name'),
        'www' => $request->input('www'),
      ]);

      if ($request->hasFile('logo')) {
        Storage::delete($registrar->logo);

        $registrar->update([
          'logo' => $request->file('logo')->store('public/registrar/avatar'),
        ]);
      }

      return redirect()->route('admin.registrars.index')->with('status', 'Регистратор отредактирован!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $registrar = Registrar::findOrFail($id);

      Storage::delete($registrar->logo);

      $registrar->delete();

      return redirect()->route('admin.registrars.index')->with('status', 'Регистратор удалён!');
    }
}

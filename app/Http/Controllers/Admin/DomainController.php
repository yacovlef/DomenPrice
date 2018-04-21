<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Validation\Rule;

use App\Domain;

class DomainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $domains = Domain::paginate(10);

      return view('admin.domain.index',[
        'domains' => $domains,
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('admin.domain.create');
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
        'slug' => 'required|max:255|unique:domains',
        'name' => 'required|max:255|unique:domains',
      ]);

      Domain::create($request->all());

      return redirect()->route('admin.domains.index')->with('status', 'Домен добавлен!');
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
      $domain = Domain::findOrFail($id);

      return view('admin.domain.edit',[
        'domain' => $domain,
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
      $domain = Domain::findOrFail($id);

      $request->validate([
        'slug' => 'required|max:255|unique:domains',
        'slug' => Rule::unique('domains')->ignore($domain->id, 'id'),
        'name' => 'required|max:255|unique:domains',
        'name' => Rule::unique('domains')->ignore($domain->id, 'id'),
      ]);

      $domain->update($request->all());

      return redirect()->route('admin.domains.index')->with('status', 'Домен отредактирован!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $domain = Domain::findOrFail($id)->delete();

      return redirect()->route('admin.domains.index')->with('status', 'Домен удалён!');
    }
}

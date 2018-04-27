<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $users = User::all();

      return view('admin.user.index',[
        'users' => $users,
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('admin.user.create');
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
        'first_name' => 'required|max:255',
        'last_name' => 'required|max:255',
        'email' => 'required|email|max:255|unique:users',
        'password' => 'required|min:6|max:255|confirmed',
      ]);

      User::create([
          'first_name' => $request->input('first_name'),
          'last_name' => $request->input('last_name'),
          'email' => $request->input('email'),
          'password' => Hash::make($request->input('password')),
      ]);

      return redirect()->route('admin.users.index')->with('status', 'Пользователь добавлен!');
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
      $user = User::findOrFail($id);

      return view('admin.user.edit',[
        'user' => $user,
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
      $user = User::findOrFail($id);

      $request->validate([
        'first_name' => 'required|max:255',
        'last_name' => 'required|max:255',
        'email' => [
          'required', 'email', 'max:255',
          Rule::unique('users')->ignore($user->id, 'id'),
        ],
        'password' => 'nullable|min:6|max:255|confirmed',
      ]);

      $user->update([
        'first_name' => $request->input('first_name'),
        'last_name' => $request->input('last_name'),
        'email' => $request->input('email'),
      ]);

      if ($request->filled('password')) {
        $user->update([
          'password' => Hash::make($request->input('password')),
        ]);
      }

      return redirect()->route('admin.users.index')->with('status', 'Пользователь отредактирован!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $user = User::findOrFail($id)->delete();

      return redirect()->route('admin.users.index')->with('status', 'Пользователь удалён!');
    }

    public function login(Request $request)
    {
      $request->validate([
        'email' => 'required|email',
        'password' => 'required',
      ]);

      if (Auth::attempt([
        'email' => $request->input('email'),
        'password' => $request->input('password'),
      ])) {

          return redirect()->intended();
      }

      return redirect()->route('admin.login')->with('status', 'Не верная эл. почта или пароль!');

    }

    public function logout()
    {
      Auth::logout();

      return redirect()->route('index');
    }
}

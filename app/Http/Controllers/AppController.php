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

  public function about()
  {
    return view('about');
  }

  public function feedback()
  {
    return view('feedback');
  }

  public function send(Request $request)
  {
    $request->validate([
      'feedback_name' => 'required',
      'feedback_email' => 'required|email',
      'feedback_message' => 'required',
    ]);

    return redirect()->route('feedback')->with('status', 'Письмо отправлено!');
  }
}

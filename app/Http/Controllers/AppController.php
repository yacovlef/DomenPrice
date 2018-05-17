<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;

use App\Domain;
use App\Price;

use App\Mail\Feedback;

class AppController extends Controller
{
  public function index()
  {
    $domains = Domain::withCount('prices')->orderBy('prices_count', 'desc')->paginate(15);

    $priceUpdateLast = Price::orderBy('updated_at', 'desc')->first()->updated_at->diffForHumans();

    return view('index',[
      'domains' => $domains,
      'priceUpdateLast' => $priceUpdateLast,
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

    $email = (object) $request->all();

    Mail::to('yacovlef@gmail.com')->send(new Feedback($email));

    return redirect()->route('feedback')->with('status', 'Письмо отправлено!');
  }
}

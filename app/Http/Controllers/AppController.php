<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

use App\Domain;
use App\Price;
use App\Registrar;

use App\Mail\Feedback;

class AppController extends Controller
{
  public function index()
  {

    $domains = DB::table('domains')
      ->select('slug', 'name')
      ->selectRaw('(SELECT price FROM prices WHERE prices.domain_id = domains.id ORDER BY price LIMIT 1) registrar_price')
      ->selectRaw('(SELECT registrars.logo NAME FROM prices JOIN registrars ON registrars.id = prices.registrar_id WHERE prices.domain_id = domains.id ORDER BY price LIMIT 1) registrar_logo')
      ->selectRaw('(SELECT registrars.name NAME FROM prices JOIN registrars ON registrars.id = prices.registrar_id WHERE prices.domain_id = domains.id ORDER BY price LIMIT 1) registrar_name')
      ->selectRaw('(SELECT registrars.www NAME FROM prices JOIN registrars ON registrars.id = prices.registrar_id WHERE prices.domain_id = domains.id ORDER BY price LIMIT 1) registrar_www')
      ->selectRaw('(SELECT COUNT(*) FROM prices WHERE prices.domain_id = domains.id) prices_count')
      ->orderBy('registrar_price')
      ->paginate(20);

    $domainsCount = Domain::count();
    $registrarsCount = Registrar::count();
    $pricesCount = Price::count();
    $priceUpdateLast = Price::orderBy('updated_at', 'desc')->first()->updated_at->diffForHumans();

    return view('index',[
      'domains' => $domains,
      'domainsCount' => $domainsCount,
      'registrarsCount' => $registrarsCount,
      'pricesCount' => $pricesCount,
      'priceUpdateLast' => $priceUpdateLast,
    ]);
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

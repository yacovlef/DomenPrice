@extends('layout.app')

@section('title', ' | О сервисе')

@section('content')
  <div class="row">
    <div class="col text-center">
      <h5>О сервисе</h5>
    </div>
  </div>
  <div class="row justify-content-center">
    <div class="col col-sm-8 col-md-6">
      <p><strong>{{ env('APP_NAME') }}</strong> - помогает найти лучшее ценовое предложение на покупку доменного имени.</p>
    </div>
  </div>
@endsection

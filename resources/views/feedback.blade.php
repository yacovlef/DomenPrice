@extends('layout.app')

@section('title', ' | Обратная связь')

@section('content')
  <div class="row">
    <div class="col text-center">
      <h5>Обратная связь</h5>
    </div>
  </div>
  <div class="row justify-content-center">
    <div class="col col-sm-10 col-md-8">
      @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('status') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
       </div>
      @endif

     <form enctype="multipart/form-data" method="post" action="{{ route('send') }}">
       @csrf

       <div class="form-group">
         <label for="feedback_name">Представьтесь</label>
         <input id="feedback_name" name="feedback_name" type="text" class="form-control{{ ($errors->has('feedback_name')) ? ' is-invalid' : null }}" value="{{ old('feedback_name') }}">

         @if ($errors->has('feedback_name'))
          <div class="invalid-feedback">
            {{ $errors->first('feedback_name') }}
          </div>
        @endif
        </div>

        <div class="form-group">
          <label for="feedback_email">Ваша эл. почта</label>
          <input id="feedback_email" name="feedback_email" type="text" class="form-control{{ ($errors->has('feedback_email')) ? ' is-invalid' : null }}" value="{{ old('feedback_email') }}">

          @if ($errors->has('feedback_email'))
           <div class="invalid-feedback">
            {{ $errors->first('feedback_email') }}
           </div>
          @endif
        </div>

        <div class="form-group">
          <label for="feedback_message">Сообщение</label>
          <textarea id="feedback_message" name="feedback_message" class="form-control{{ ($errors->has('feedback_message')) ? ' is-invalid' : null }}" value="{{ old('feedback_message') }}" rows="5">{{ old('feedback_message') }}</textarea>

          @if ($errors->has('feedback_message'))
            <div class="invalid-feedback">
              {{ $errors->first('feedback_message') }}
            </div>
          @endif
        </div>

        <button type="submit" class="btn btn-block btn-outline-dark">Отправить</button>
      </form>
    </div>
  </div>
@endsection

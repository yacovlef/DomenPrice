@extends('admin.layout.admin')

@section('title', ' | Панель администратора | Пользователи | Новый пользователь')

@section('content')
  @include('admin.user._form')
@endsection

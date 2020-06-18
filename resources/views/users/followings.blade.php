@extends('app')

@section('title', $user->name . 'さんのフォロー中')

@section('content')
  @include('header')
  <div class="container">
    @include('users.user')
    @foreach($followings as $person)
      @include('users.person')
    @endforeach
  </div>
@endsection

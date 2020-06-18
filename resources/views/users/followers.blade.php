@extends('app')

@section('title', $user->name . 'さんのフォロワー')

@section('content')
  @include('header')
  <div class="container">
    @include('users.user')
    @foreach($followers as $person)
      @include('users.person')
    @endforeach
  </div>
@endsection

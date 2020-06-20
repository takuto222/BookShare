@extends('app')

@section('title', 'プロフィール編集')

@include('header')

@section('css')

@endsection

@section('js')

@endsection

@section('content')
<div class="container create-article-form-container">
  <div class="row">
    <div class="col-12">
      <div class="card mt-3">
        <div class="card-body pt-0">
          @include('error_card_list')
          <div class="card-text">
            <form method="POST" action="{{ route("users.update", ["user" => Auth::user()]) }}" enctype="multipart/form-data">
              @include('users.form')
              <button type="submit" class="btn blue-gradient btn-block mt-5 mb-4">編集する</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

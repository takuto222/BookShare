@extends('app')

@section('title', '記事更新')

@include('header')

@section('css')
  <link href="{{ asset('css/articles/create.css') }}" rel="stylesheet">
@endsection

@section('js')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.4.2/jquery.twbsPagination.min.js"></script>
  <script src="{{ asset('js/articles/create.js') }}"></script>
@endsection

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="card mt-3">
          <div class="card-body pt-0">
            @include('error_card_list')
            <div class="card-text">
              <form method="POST" action="{{ route('articles.update', ['article' => $article]) }}" enctype="multipart/form-data">
                @method('PATCH')
                @include('articles.form')
                <button type="submit" class="btn blue-gradient btn-block mt-5">更新する</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
